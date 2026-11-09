<?php

session_start();

include("../config/database.php");

if(!isset($_SESSION['doctor_id']))
{
    header("Location: doctor_login.php");
    exit();
}

$doctor_id = $_SESSION['doctor_id'];

$query = mysqli_query(
$conn,
"SELECT *
FROM doctors
WHERE doctor_id='$doctor_id'"
);

$doctor = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Doctor Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body class="bg-light">

<div class="container py-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>Doctor Profile</h3>

</div>

<div class="card-body">

<p>

<strong>Name:</strong>

<?php echo $doctor['doctor_name']; ?>

</p>

<p>

<strong>Email:</strong>

<?php echo $doctor['email']; ?>

</p>

<p>

<strong>Mobile:</strong>

<?php echo $doctor['mobile']; ?>

</p>

<?php
if(isset($doctor['specialization']))
{
?>

<p>

<strong>Specialization:</strong>

<?php echo $doctor['specialization']; ?>

</p>

<?php
}
?>

<a href="dashboard.php"
class="btn btn-primary">

Back To Dashboard

</a>

</div>

</div>

</div>

</body>

</html>