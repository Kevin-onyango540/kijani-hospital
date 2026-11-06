<?php
session_start();
include 'db_connect.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    if($result->num_rows == 1){
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])){
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Wrong password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login - Kijani Hospital</title>
<style>
body { font-family: Arial; display:flex; justify-content:center; align-items:center; height:100vh; background:#e8f5e9; margin:0; }
.card { background:white; padding:30px; border-radius:10px; box-shadow:0 4px 20px #aaa; width:350px; }
input { width:100%; padding:12px; margin:8px 0; border-radius:5px; border:1px solid #ccc; box-sizing:border-box; }
button { width:100%; padding:12px; background:#2e7d32; color:white; border:none; border-radius:5px; font-size:16px; cursor:pointer; }
.error { background:#f8d7da; color:#721c24; padding:10px; border-radius:5px; margin-bottom:10px; }
</style>
</head>
<body>
<div class="card">
<h2 style="text-align:center;">🏥 Kijani Hospital Login</h2>
<?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
<form method="POST">
Username: <input type="text" name="username" required value="admin">
Password: <input type="password" name="password" required value="admin123">
<br><br>
<button type="submit" name="login">Login</button>
</form>
<p style="font-size:12px; text-align:center; margin-top:15px;">Default: admin / admin123</p>
</div>
</body>
</html>