<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {

    $pertanyaan = $_POST['pertanyaan'];
    $opsi = $_POST['opsi'];
    $jawaban = $_POST['jawaban'];
    $level = $_POST['level'];

    $query = "INSERT INTO soal (pertanyaan, opsi, jawaban, level)
              VALUES ('$pertanyaan', '$opsi', '$jawaban', '$level')";

    if (mysqli_query($conn, $query)) {
        echo "Soal berhasil disimpan!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<link rel="stylesheet" href="style.css">

<h2>Tambah Soal</h2>

<form method="POST">
    <textarea name="pertanyaan" placeholder="Masukkan soal"></textarea><br><br>

    <textarea name="opsi" placeholder="Contoh: A|B|C|D"></textarea><br><br>

    <input type="text" name="jawaban" placeholder="Jawaban (A/B/C/D)"><br><br>

    <input type="text" name="level" placeholder="easy/medium/hard"><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>