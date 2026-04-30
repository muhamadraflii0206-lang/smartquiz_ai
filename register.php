<?php
include "koneksi.php";

if (isset($_POST['daftar'])) {

    $u = $_POST['username'];
    $p = $_POST['password'];
    $r = $_POST['role'];

    mysqli_query($conn, "INSERT INTO users (username, password, role)
    VALUES ('$u','$p','$r')");

    echo "Akun berhasil dibuat!";
}
?>

<link rel="stylesheet" href="style.css">

<link rel="stylesheet" href="style.css">


<h2>Register</h2>

<form method="POST">

<label>Buat Username</label>
<input type="text" name="username" required>

<label>Buat Password</label>
<input type="password" name="password" id="password" required>

<div style="margin:10px 0;">
    <label style="display:inline-flex; align-items:center; cursor:pointer;">
        <input type="checkbox" onclick="togglePassword()" style="width:auto; margin:0 5px 0 0; display:inline;">
        Tampilkan Password
    </label>
</div>

<label>Role</label>
<select name="role" required>
    <option value="dosen">Dosen</option>
    <option value="mahasiswa">Mahasiswa</option>
</select>
<br><br>

<button name="daftar">Daftar</button>

<p style="text-align:center; margin-top:12px;">
Sudah punya akun? <a href="login.php">Login</a>
</p>

</form>

<script>
function togglePassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>