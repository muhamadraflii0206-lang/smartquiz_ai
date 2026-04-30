<?php
include "koneksi.php";
session_start();

echo '<link rel="stylesheet" href="style.css">';

$jawaban_user = $_POST['jawaban'];
$kode = $_POST['kode'];

$query = mysqli_query($conn, "SELECT * FROM soal WHERE kode_quiz='$kode' AND aktif=1");

$skor = 0;
$total = 0;

echo "<h2>Hasil Quiz</h2><br>";

while ($row = mysqli_fetch_assoc($query)) {

    $id = $row['id'];
    $opsi = explode("|", $row['opsi']);

    $jawaban = $jawaban_user[$id] ?? "-";
    $benar = $row['jawaban'];

    echo "<b>" . $row['pertanyaan'] . "</b><br>";

    echo "A.) " . $opsi[0] . "<br>";
    echo "B.) " . $opsi[1] . "<br>";
    echo "C.) " . $opsi[2] . "<br>";
    echo "D.) " . $opsi[3] . "<br><br>";

    echo "Jawaban kamu: <b>$jawaban</b><br>";
    echo "Jawaban benar: <b>$benar</b><br>";

    if ($jawaban == $benar) {
        echo "<span style='color:green'>✔ Benar</span><br>";
        $skor++;
    } else {
        echo "<span style='color:red'>✘ Salah</span><br>";
    }

    echo "<hr>";

    $total++;
}

echo "<h3>Skor kamu: $skor / $total</h3><br>";
$user_id = $_SESSION['user_id'];

mysqli_query($conn, "INSERT INTO hasil (user_id, skor, kode_quiz)
VALUES ('$user_id', '$skor', '$kode')");

?>

<a href="dashboard.php">⬅️ Kembali ke Dashboard</a> | 
<a href="logout.php">Logout</a>