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

$cek = mysqli_query($conn, "
SELECT * FROM hasil 
WHERE user_id='$user_id' 
AND kode_quiz='$kode'
");

if (mysqli_num_rows($cek) > 0) {
    echo "Kamu sudah mengerjakan quiz ini!";
    echo "<br><br>";
    echo "<a href='dashboard.php' class='btn'>⬅️ Kembali</a>";
    exit;
}

$query = mysqli_query($conn, "
SELECT * FROM soal 
WHERE kode_quiz='$kode' 
AND aktif=1 
LIMIT 10
");

$no = 1;
?>

<div class="card">

<h2>Quiz</h2>

<form method="POST" action="hasil.php">

<input type="hidden" name="kode" value="<?php echo $kode; ?>">

<?php while ($row = mysqli_fetch_assoc($query)) { ?>

<div style="
border:1px solid #ddd;
padding:20px;
margin-bottom:20px;
border-radius:12px;
background:#fff;
text-align:left;
box-shadow:0 2px 8px rgba(0,0,0,0.1);
">

<p style="
font-size:18px;
font-weight:bold;
margin-bottom:20px;
">
<?php echo $no . ". " . $row['pertanyaan']; ?>
</p>

<?php $opsi = explode("|", $row['opsi']); ?>

<div style="margin-bottom:12px;">
<label style="cursor:pointer;">
<input type="radio"
name="jawaban[<?php echo $row['id']; ?>]"
value="A">

A. <?php echo $opsi[0]; ?>
</label>
</div>

<div style="margin-bottom:12px;">
<label style="cursor:pointer;">
<input type="radio"
name="jawaban[<?php echo $row['id']; ?>]"
value="B">

B. <?php echo $opsi[1]; ?>
</label>
</div>

<div style="margin-bottom:12px;">
<label style="cursor:pointer;">
<input type="radio"
name="jawaban[<?php echo $row['id']; ?>]"
value="C">

C. <?php echo $opsi[2]; ?>
</label>
</div>

<div style="margin-bottom:12px;">
<label style="cursor:pointer;">
<input type="radio"
name="jawaban[<?php echo $row['id']; ?>]"
value="D">

D. <?php echo $opsi[3]; ?>
</label>
</div>

</div>

<?php $no++; } ?>

<button type="submit" class="btn">
Kirim Jawaban
</button>

</form>

</div>
