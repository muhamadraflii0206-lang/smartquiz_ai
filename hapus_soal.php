<?php
include "koneksi.php";
session_start();

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// pastikan hanya hapus soal miliknya
mysqli_query($conn, "DELETE FROM soal WHERE id='$id' AND user_id='$user_id'");

header("Location: lihat_soal.php");
?>