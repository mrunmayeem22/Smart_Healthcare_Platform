<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../config/database.php");

if(isset($_POST['add']))
{
    $doctor_name = $_POST['doctor_name'];
    $specialization = $_POST['specialization'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    mysqli_query(
    $conn,
    "INSERT INTO doctors
    (
    doctor_name,
    specialization,
    email,
    mobile,
    password
    )
    VALUES
    (
    '$doctor_name',
    '$specialization',
    '$email',
    '$mobile',
    '$password'
    )"
    );

    $success="Doctor Added Successfully";
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Add Doctor</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container py-5">

<h2>Add Doctor</h2>

<?php
if(isset($success))
{
echo "<div class='alert alert-success'>$success</div>";
}
?>

<form method="POST">

<input
type="text"
name="doctor_name"
placeholder="Doctor Name"
class="form-control mb-3"
required>

<input
type="text"
name="specialization"
placeholder="Specialization"
class="form-control mb-3"
required>

<input
type="email"
name="email"
placeholder="Email"
class="form-control mb-3"
required>

<input
type="text"
name="mobile"
placeholder="Mobile"
class="form-control mb-3"
required>

<input
type="password"
name="password"
placeholder="Password"
class="form-control mb-3"
required>

<button
name="add"
class="btn btn-primary">

Add Doctor

</button>

</form>

</body>
</html>
