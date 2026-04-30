<?php 
include "koneksi.php";
session_start();

echo '<link rel="stylesheet" href="style.css">';

/* API KEY (Elephant) */
$API_KEY = "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";

/*  CEK LOGIN */
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

/* ================== FUNGSI AI ================== */
function generateSoalAI_API($materi, $API_KEY) {

    $prompt = "Dari teks berikut:\n\n$materi\n\nBuatkan 10 soal pilihan ganda yang BERAGAM (tidak hanya definisi). 
Variasikan tipe soal seperti:
- konsep
- pemahaman
- contoh
- sebab-akibat
- aplikasi

Setiap soal harus memiliki:
- 1 jawaban benar
- 3 pengecoh yang masuk akal (relevan dengan soal)

Format JSON WAJIB seperti ini:
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
            ["role" => "user", "content" => $prompt]
        ]
    ];

    $ch = curl_init("https://openrouter.ai/api/v1/chat/completions");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $API_KEY",
    "HTTP-Referer: http://localhost",
    "X-Title: SmartQuiz"
]);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);

if ($response === false) {
    echo curl_error($ch);
    exit;
}

    curl_close($ch);

    $result = json_decode($response, true);

    if (!isset($result['choices'][0]['message']['content'])) {
        return null;
    }

    $content = $result['choices'][0]['message']['content'];

    // bersihkan format markdown kalau ada
    $content = preg_replace('/```json|```/', '', $content);

    $json = json_decode($content, true);

    if (!$json) {
        return null;
    }

    $hasil = [];

    foreach ($json as $item) {

        $opsi = $item['A']."|".$item['B']."|".$item['C']."|".$item['D'];

        $hasil[] = [
            "pertanyaan" => $item['pertanyaan'],
            "opsi" => $opsi,
            "jawaban" => $item['jawaban'],
            "level" => $item['level']
        ];
    }

    return $hasil;
}


/* ================== PROSES GENERATE ================== */
if (isset($_POST['generate'])) {

    $user_id = $_SESSION['user_id'];
    $materi = $_POST['materi'];

    // buat kode quiz
    $kode_quiz = strtoupper(substr(md5(rand()), 0, 6));

    // panggil AI
    $hasil = generateSoalAI_API($materi, $API_KEY);

    if (!$hasil) {
        echo "<b style='color:red'>AI gagal generate soal! (cek API / cURL)</b>";
        exit;
    }

    //  simpan ke database
    foreach ($hasil as $soal) {
        mysqli_query($conn, "INSERT INTO soal (pertanyaan, opsi, jawaban, level, user_id, kode_quiz)
        VALUES ('{$soal['pertanyaan']}', '{$soal['opsi']}', '{$soal['jawaban']}', '{$soal['level']}', '$user_id', '$kode_quiz')");
    }

    echo "<b>Soal berhasil dibuat dengan AI!</b><br>";
    echo "Kode Quiz: <b>$kode_quiz</b><br><br>";
}
?>

<h2>Generate Soal (AI)</h2>

<a href="dashboard.php" class="btn">⬅️ Dashboard</a>| 
<a href="lihat_soal.php" class="btn">📄 Lihat Soal</a>

<br><br>

<form method="POST">
<textarea name="materi" rows="10" cols="80" placeholder="Masukkan materi di sini..."></textarea><br><br>
<button type="submit" name="generate">Generate Soal AI</button>
</form>

<p style="text-align:center; color:gray;">
Masukkan materi, lalu sistem akan otomatis membuat soal berbasis AI.
</p>