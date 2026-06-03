<?php
include "koneksi.php";
session_start();

echo '<link rel="stylesheet" href="style.css">';

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// ambil data soal milik user
$q = mysqli_query($conn, "SELECT * FROM soal WHERE id='$id' AND user_id='$user_id'");
$data = mysqli_fetch_assoc($q);

// pecah opsi
$opsi = explode("|", $data['opsi']);

if (isset($_POST['simpan'])) {

    $pertanyaan = $_POST['pertanyaan'];
    $opsiA = $_POST['opsiA'];
    $opsiB = $_POST['opsiB'];
    $opsiC = $_POST['opsiC'];
    $opsiD = $_POST['opsiD'];
    $jawaban = $_POST['jawaban'];

    $opsiGabung = "$opsiA|$opsiB|$opsiC|$opsiD";

    mysqli_query($conn, "UPDATE soal SET 
        pertanyaan='$pertanyaan',
        opsi='$opsiGabung',
        jawaban='$jawaban'
        WHERE id='$id' AND user_id='$user_id'
    ");

    header("Location: lihat_soal.php");
}
?>

<h2>Edit Soal</h2>

<form method="POST">
Pertanyaan:<br>
<input type="text" name="pertanyaan" value="<?php echo $data['pertanyaan']; ?>"><br><br>

A: <input type="text" name="opsiA" value="<?php echo $opsi[0]; ?>"><br>
B: <input type="text" name="opsiB" value="<?php echo $opsi[1]; ?>"><br>
C: <input type="text" name="opsiC" value="<?php echo $opsi[2]; ?>"><br>
D: <input type="text" name="opsiD" value="<?php echo $opsi[3]; ?>"><br><br>

Jawaban benar:
<select name="jawaban">
    <option value="A">A</option>
    <option value="B">B</option>
    <option value="C">C</option>
    <option value="D">D</option>
</select><br><br>

<button name="simpan">Simpan</button>
</form>