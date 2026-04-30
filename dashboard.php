<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<link rel="stylesheet" href="style.css">

<div class="header">
    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png">
    <h1>Smart Quiz AI</h1>
</div>

<div class="card">

<h2 style="text-align:center;">Dashboard</h2>

<p style="text-align:center;">
Selamat datang, <b><?php echo $_SESSION['username'] ?? 'User'; ?></b><br>
ID: <?php echo $_SESSION['user_id']; ?><br>
Role: <?php echo $_SESSION['role']; ?>
</p>

<hr>

<div class="nav">
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<hr>

<?php if ($_SESSION['role'] == 'dosen') { ?>

    <div class="menu">
        <a href="generate.php" class="btn">📄 Generate Soal</a>
        <a href="lihat_soal.php" class="btn">✏️ Lihat & Edit Soal</a>
        <a href="lihat_semua_hasil.php" class="btn">📊 Hasil Mahasiswa</a>
    </div>

<?php } ?>

<?php if ($_SESSION['role'] == 'mahasiswa') { ?>

    <div class="menu">
        <a href="masuk_quiz.php" class="btn">📝 Kerjakan Quiz</a>
        <a href="lihat_hasil.php" class="btn">📊 Lihat Hasil</a>
    </div>

<?php } ?>

<?php if ($_SESSION['role'] == 'admin') { ?>

    <div class="menu">
        <a href="generate.php" class="btn">📄 Generate Soal</a>
        <a href="lihat_soal.php" class="btn">📋 Lihat Soal</a>
    </div>

<?php } ?>

</div>