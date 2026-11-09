<?php

session_start();
include("../config/database.php");

if(isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];

    $query=mysqli_query(
        $conn,
        "SELECT * FROM users
        WHERE email='$email'
        AND password='$password'"
    );

    if(mysqli_num_rows($query)>0)
    {
        $user=mysqli_fetch_assoc($query);

        $_SESSION['user_id']=$user['user_id'];
        $_SESSION['full_name']=$user['full_name'];

        header("Location: dashboard.php");
        exit();
    }
    else
    {
        $error="Invalid Email or Password";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Patient Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
href="../assets/css/patient.css">

</head>

<body>

<div class="auth-container">

<div class="auth-card">

<div class="logo">

<h1>🏥 MediSphere AI</h1>

<p>Patient Login</p>

</div>

<?php
if(isset($_GET['success']))
{
echo "<p style='color:green;text-align:center'>
Registration Successful. Please Login.
</p>";
}
?>

<?php
if(isset($error))
{
echo "<p style='color:red;text-align:center'>
$error
</p>";
}
?>

<form method="POST">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

<button
name="login"
class="btn-primary">

Login

</button>

</form>

<div class="links">

<a href="forgot_password.php">

Forgot Password?

</a>

<a href="register.php">

Don't have an account?
Register

</a>

<a href="../index.php">

Back To Home

</a>

</div>

</div>

</div>

</body>
</html>