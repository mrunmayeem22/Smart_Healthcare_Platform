<?php

include("../config/database.php");

if(isset($_POST['register']))
{
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $mobile=$_POST['mobile'];
    $address=$_POST['address'];

    mysqli_query(
    $conn,
    "INSERT INTO users
    (
    full_name,
    username,
    email,
    password,
    mobile,
    address
    )
    VALUES
    (
    '$full_name',
    '$username',
    '$email',
    '$password',
    '$mobile',
    '$address'
    )"
    );

    header("Location: login.php?success=1");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Patient Registration</title>

<link rel="stylesheet"
href="../assets/css/patient.css">

</head>

<body>

<div class="auth-container">

<div class="auth-card">

<div class="logo">

<h1>🏥 MediSphere AI</h1>

<p>Create Patient Account</p>

</div>

<form method="POST">

<input
type="text"
name="full_name"
placeholder="Full Name"
class="form-control"
required>

<input
type="text"
name="username"
placeholder="Username"
class="form-control"
required>

<input
type="email"
name="email"
placeholder="Email"
class="form-control"
required>

<input
type="password"
name="password"
placeholder="Password"
class="form-control"
required>

<input
type="text"
name="mobile"
placeholder="Mobile"
class="form-control"
required>

<textarea
name="address"
class="form-control"
placeholder="Address"
required></textarea>

<button
name="register"
class="btn-primary">

Register

</button>

</form>

<div class="links">

<a href="login.php">

Already have an account?
Login

</a>

</div>

</div>

</div>

</body>
</html> 