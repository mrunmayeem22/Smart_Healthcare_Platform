<?php

include("../config/database.php");

if(isset($_POST['reset']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];

    mysqli_query(
    $conn,
    "UPDATE users
    SET password='$password'
    WHERE email='$email'"
    );

    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forgot Password</title>
<link rel="stylesheet"
href="../assets/css/patient.css">
</head>
<body>
<div class="auth-container">
<div class="auth-card">
<div class="logo">
<h1>🔐 Reset Password</h1>
</div>
<form method="POST">

<input
type="email"
name="email"
placeholder="Email"
class="form-control"
required>

<input
type="password"
name="password"
placeholder="New Password"
class="form-control"
required>

<button
name="reset"
class="btn-primary">
Reset Password
</button>
</form>
<div class="links">
<a href="login.php">
Back To Login
</a>
</div>
</div>
</div>
</body>
</html>