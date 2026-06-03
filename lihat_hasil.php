<?php
include "koneksi.php";
session_start();

$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn, "
    SELECT * FROM hasil 
    WHERE user_id='$user_id'
");

echo "<h2>Riwayat Hasil Quiz</h2>";

echo "<table border='1' cellpadding='8' cellspacing='0'>
<tr>
<th>No</th>
<th>Kode Quiz</th>
<th>Skor</th>
<th>Tanggal</th>
</tr>";

$no = 1;

if (mysqli_num_rows($query) > 0) {

    while ($row = mysqli_fetch_assoc($query)) {

        echo "<tr>
        <td>".$no++."</td>
        <td>".$row['kode_quiz']."</td>
        <td>".$row['skor']."</td>
        <td>".$row['tanggal']."</td>
        </tr>";
    }

} else {
    echo "<tr><td colspan='4'>Belum ada data</td></tr>";
}

echo "</table>";
?>

<br>
<a href="dashboard.php">⬅️ Kembali</a>
