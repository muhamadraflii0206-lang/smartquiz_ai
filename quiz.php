<?php
include "koneksi.php";
session_start();
?>

<link rel="stylesheet" href="style.css">

<?php

if (!isset($_GET['kode'])) {
    echo "Kode quiz tidak ditemukan!";
    exit;
}

$kode = $_GET['kode'];
$user_id = $_SESSION['user_id'];

$cek = mysqli_query($conn, "SELECT * FROM hasil WHERE user_id='$user_id' AND kode_quiz='$kode'");

if (mysqli_num_rows($cek) > 0) {
    echo "Kamu sudah mengerjakan quiz ini!";
    echo "<br><a href='dashboard.php'>Kembali</a>";
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM soal WHERE kode_quiz='$kode' AND aktif=1 LIMIT 10");

$no = 1;
?>

<h2>Quiz</h2>

<form method="POST" action="hasil.php">

<input type="hidden" name="kode" value="<?php echo $kode; ?>">

<?php while ($row = mysqli_fetch_assoc($query)) { ?>

    <p><b><?php echo $no . ". " . $row['pertanyaan']; ?></b></p>

    <?php $opsi = explode("|", $row['opsi']); ?>

    <input type="radio" name="jawaban[<?php echo $row['id']; ?>]" value="A">
    A.) <?php echo $opsi[0]; ?><br>

    <input type="radio" name="jawaban[<?php echo $row['id']; ?>]" value="B">
    B.) <?php echo $opsi[1]; ?><br>

    <input type="radio" name="jawaban[<?php echo $row['id']; ?>]" value="C">
    C.) <?php echo $opsi[2]; ?><br>

    <input type="radio" name="jawaban[<?php echo $row['id']; ?>]" value="D">
    D.) <?php echo $opsi[3]; ?><br>

    <br>

<?php $no++; } ?>

<button type="submit">Kirim Jawaban</button>

</form>