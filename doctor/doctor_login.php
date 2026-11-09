<?php

session_start();

include("../config/database.php");

if(isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];

    $query=mysqli_query(
        $conn,
        "SELECT * FROM doctors
        WHERE email='$email'
        AND password='$password'"
    );

    if(mysqli_num_rows($query)>0)
    {
        $doctor=mysqli_fetch_assoc($query);

        $_SESSION['doctor_id']=$doctor['doctor_id'];
        $_SESSION['doctor_name']=$doctor['doctor_name'];

        header("Location: dashboard.php");
        exit();
    }
    else
    {
        $error="Invalid Login Credentials";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Doctor Login</title>

<link rel="stylesheet"
href="../assets/css/doctor.css">

</head>

<body>

<div class="auth-container">

<div class="auth-card">

<div class="logo">

<h1>👨‍⚕️ MediSphere AI</h1>

<p>Doctor Portal</p>

</div>

<?php
if(isset($error))
{
echo "<p style='color:red;text-align:center'>$error</p>";
}
?>

<form method="POST">

<input
type="email"
name="email"
class="form-control"
placeholder="Email"
required>

<input
type="password"
name="password"
class="form-control"
placeholder="Password"
required>

<button
name="login"
class="btn-login">

Login

</button>

</form>

<br>

<div style="text-align:center">

<a href="../index.php">
Back To Home
</a>

</div>

</div>

</div>

</body>
</html>