<?php
include "koneksi.php";
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$kode = $_GET['kode'] ?? '';
?>

<link rel="stylesheet" href="style.css">

<div class="card">

<h2>Hasil Mahasiswa</h2>

<div style="margin-bottom:10px;">
    <a href="dashboard.php" class="btn">⬅️ Dashboard</a>
    <div style="margin-bottom:10px;">
    <a href="lihat_semua_hasil.php" class="btn">🔙 Kode Quiz</a>
</div>
</div>

<hr>

<?php
// STEP 1: PILIH QUIZ
if ($kode == '') {

    $q = mysqli_query($conn, "SELECT DISTINCT kode_quiz FROM soal WHERE user_id='$user_id'");

    echo "<h3>Pilih Quiz</h3>";

    if (mysqli_num_rows($q) > 0) {
        while ($d = mysqli_fetch_assoc($q)) {
            echo "<a class='btn' href='lihat_semua_hasil.php?kode=".$d['kode_quiz']."'>".$d['kode_quiz']."</a> ";
        }
    } else {
        echo "<p>Belum ada quiz</p>";
    }

    echo "</div>";
    exit;
}

// STEP 2: AMBIL DATA
$result = mysqli_query($conn, "
    SELECT hasil.*, users.username 
    FROM hasil 
    JOIN users ON hasil.user_id = users.id 
    WHERE hasil.kode_quiz='$kode'
");
?>

<h3>Kode Quiz: <?php echo $kode; ?></h3>

<div style="overflow-x:auto;">

<table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse;">

<tr style="background:#4a69bd; color:white;">
    <th>No</th>
    <th>Username</th>
    <th>Skor</th>
    <th>Tanggal</th>
</tr>

<?php
$no = 1;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $row['username']; ?></td>
    <td><?php echo $row['skor']; ?></td>
    <td><?php echo $row['tanggal']; ?></td>
</tr>
<?php
    }
} else {
?>
<tr>
    <td colspan="4">Belum ada yang mengerjakan</td>
</tr>
<?php } ?>

</table>

</div>

</div>