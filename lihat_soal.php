<?php
include "koneksi.php";
session_start();

echo '<link rel="stylesheet" href="style.css">';

// proteksi login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// aktif / nonaktif soal
if (isset($_POST['aktifkan'])) {
    $id = $_POST['id'];
    mysqli_query($conn, "UPDATE soal SET aktif=1 WHERE id='$id'");
}

if (isset($_POST['nonaktifkan'])) {
    $id = $_POST['id'];
    mysqli_query($conn, "UPDATE soal SET aktif=0 WHERE id='$id'");
}

$user_id = $_SESSION['user_id'];

/* 🔥 AMBIL KODE QUIZ */
$kode = $_GET['kode'] ?? '';

?>

<h2>Daftar Soal</h2>


<a href="dashboard.php" class="btn"> ⬅️ Dashboard</a> |
<a href="generate.php" class="btn"> ➕ Generate</a>

<br><br>

<?php
/* 🔥 TAMPILKAN LIST QUIZ */
echo "<h3>Pilih Quiz:</h3>";

$list = mysqli_query($conn, "SELECT DISTINCT kode_quiz FROM soal WHERE user_id='$user_id'");

while ($d = mysqli_fetch_assoc($list)) {
    echo "<a href='lihat_soal.php?kode=".$d['kode_quiz']."'>📘 Quiz ".$d['kode_quiz']."</a><br>";
}

echo "<hr>";

/* 🔥 KALAU BELUM PILIH QUIZ */
if ($kode == '') {
    echo "Silakan pilih quiz terlebih dahulu.";
    exit;
}

/* 🔥 AMBIL SOAL BERDASARKAN KODE */
$query = mysqli_query($conn, "SELECT * FROM soal WHERE user_id='$user_id' AND kode_quiz='$kode'");

$no = 1;
?>

<h3>Soal untuk Quiz: <?php echo $kode; ?></h3><br>

<?php while ($data = mysqli_fetch_assoc($query)) { ?>

    <b><?php echo $no++; ?>. <?php echo $data['pertanyaan']; ?> (<?php echo $data['level']; ?>)</b><br>

    <?php $opsi = explode("|", $data['opsi']); ?>

    A.) <?php echo $opsi[0]; ?><br>
    B.) <?php echo $opsi[1]; ?><br>
    C.) <?php echo $opsi[2]; ?><br>
    D.) <?php echo $opsi[3]; ?><br>

    <i>Jawaban: <?php echo $data['jawaban']; ?></i><br><br>

    <!-- 🔥 TOMBOL AKSI -->
    <a href="edit_soal.php?id=<?php echo $data['id']; ?>">✏️ Edit</a> | 
    <a href="hapus_soal.php?id=<?php echo $data['id']; ?>" onclick="return confirm('Yakin hapus soal ini?')">🗑️ Hapus</a>

    <br><br>

    <!-- 🔥 AKTIF / NONAKTIF -->
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

        <?php if ($data['aktif'] == 0) { ?>
            <button name="aktifkan">✔️ Pakai Soal</button>
        <?php } else { ?>
            <button name="nonaktifkan">❌ Jangan Pakai</button>
        <?php } ?>
    </form>

    <hr>

<?php } ?>