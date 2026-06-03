<?php
include "koneksi.php";
session_start();

echo '<link rel="stylesheet" href="style.css">';

/* API KEY OPENROUTER */
$API_KEY = "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";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

function generateSoalAI_API($materi, $API_KEY) {

    $prompt = "Dari teks berikut:\n\n$materi\n\nBuatkan 10 soal pilihan ganda.

Format JSON:

[
{
\"pertanyaan\":\"...\",
\"A\":\"...\",
\"B\":\"...\",
\"C\":\"...\",
\"D\":\"...\",
\"jawaban\":\"A\",
\"level\":\"easy\"
}
]";

    $data = [
        "model" => "openai/gpt-3.5-turbo",
        "messages" => [
            [
                "role" => "user",
                "content" => $prompt
            ]
        ]
    ];

    $ch = curl_init("https://openrouter.ai/api/v1/chat/completions");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer " . $API_KEY,
        "HTTP-Referer: http://localhost",
        "X-Title: SmartQuiz"
    ]);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);

    if ($response === false) {
        echo curl_error($ch);
        return null;
    }

    curl_close($ch);

    $result = json_decode($response, true);

    if (!isset($result['choices'][0]['message']['content'])) {
        echo "<pre>";
        print_r($result);
        echo "</pre>";
        return null;
    }

    $content = $result['choices'][0]['message']['content'];

    $content = preg_replace('/```json|```/', '', $content);

    $json = json_decode(trim($content), true);

    if (!$json) {
        echo "<pre>";
        echo htmlspecialchars($content);
        echo "</pre>";
        return null;
    }

    $hasil = [];

    foreach ($json as $item) {

        $opsi = $item['A'] . "|" . $item['B'] . "|" . $item['C'] . "|" . $item['D'];

        $hasil[] = [
            "pertanyaan" => $item['pertanyaan'],
            "opsi" => $opsi,
            "jawaban" => $item['jawaban'],
            "level" => $item['level']
        ];
    }

    return $hasil;
}

if (isset($_POST['generate'])) {

    $user_id = $_SESSION['user_id'];
    $materi = $_POST['materi'];

    $kode_quiz = strtoupper(substr(md5(rand()), 0, 6));

    $hasil = generateSoalAI_API($materi, $API_KEY);

    if (!$hasil) {
        echo "<b style='color:red'>AI gagal generate soal!</b>";
        exit;
    }

    foreach ($hasil as $soal) {

        mysqli_query($conn,
            "INSERT INTO soal
            (pertanyaan, opsi, jawaban, level, user_id, kode_quiz)
            VALUES
            (
                '{$soal['pertanyaan']}',
                '{$soal['opsi']}',
                '{$soal['jawaban']}',
                '{$soal['level']}',
                '$user_id',
                '$kode_quiz'
            )"
        );
    }

    echo "<b>Soal berhasil dibuat dengan AI!</b><br>";
    echo "Kode Quiz: <b>$kode_quiz</b><br><br>";
}
?>

<h2>Generate Soal (AI)</h2>

<a href="dashboard.php" class="btn">⬅️ Dashboard</a> |
<a href="lihat_soal.php" class="btn">📄 Lihat Soal</a>

<br><br>

<form method="POST">
    <textarea name="materi" rows="10" cols="80" placeholder="Masukkan materi di sini..."></textarea>
    <br><br>
    <button type="submit" name="generate">Generate Soal AI</button>
</form>

<p style="text-align:center; color:gray;">
Masukkan materi teks, lalu sistem akan otomatis membuat 10 soal pilihan ganda.
</p>