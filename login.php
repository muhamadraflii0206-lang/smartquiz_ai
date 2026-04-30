<?php
include "koneksi.php";

if (isset($_POST['login'])) {

    $u = $_POST['username'];
    $p = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$u' AND password='$p'");

    if (mysqli_num_rows($q) > 0) {

        $data = mysqli_fetch_assoc($q);

        session_start();
        $_SESSION['login'] = true;
        $_SESSION['role'] = $data['role'];
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['username'] = $data['username'];

        header("Location: dashboard.php");
    } else {
        echo "Login gagal!";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div style="text-align:center; margin-bottom:15px;">
    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png" width="80">
    <h2>Smart Quiz AI</h2>
</div>

<h2>Login</h2>

<form method="POST">

<label>Username</label>
<input type="text" name="username">

<label>Password</label>
<input type="password" name="password" id="password">

<div style="margin:10px 0;">
    <label style="display:inline-flex; align-items:center; cursor:pointer;">
        <input type="checkbox" onclick="togglePassword()" style="width:auto; margin:0 5px 0 0; display:inline;">
        Tampilkan Password
    </label>
</div>

<button name="login">Login</button>

<p style="text-align:center; margin-top:12px;">
Belum punya akun? <a href="register.php">Daftar</a>
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