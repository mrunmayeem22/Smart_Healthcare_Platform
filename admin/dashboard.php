<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../config/database.php");

$patients =
mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM users")
);

$doctors =
mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM doctors")
);

$reports =
mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM test_reports")
);

$appointments =
mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM appointments")
);

?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet"
href="../assets/css/admin.css">

</head>

<body>

<div class="sidebar">

<h3>
🏥 MediSphere AI
</h3>

<a href="dashboard.php">
<i class="bi bi-speedometer2"></i>
 Dashboard
</a>

<a href="add_doctor.php">
<i class="bi bi-person-plus"></i>
 Add Doctor
</a>

<a href="manage_doctors.php">
<i class="bi bi-people"></i>
 Manage Doctors
</a>

<a href="appointments.php">
<i class="bi bi-calendar-check"></i>
 Appointments
</a>

<a href="upload_report.php">
<i class="bi bi-upload"></i>
 Upload Report
</a>

<a href="manage_reports.php">
<i class="bi bi-file-earmark-medical"></i>
 Reports
</a>

<a href="analytics.php">
<i class="bi bi-graph-up"></i>
 Analytics
</a>

<a href="generate_qr.php"
class="btn btn-primary">
QR Verification
</a>

<a href="logout.php">
<i class="bi bi-box-arrow-right"></i>
 Logout
</a>

</div>

<div class="main">

<div class="topbar">

<h2>
Admin Control Center
</h2>

</div>

<div class="row g-4">

<div class="col-lg-4 col-md-6 col-sm-12">

<div class="card stat-card">

<div class="card-body text-center">

<i class="bi bi-person-fill text-primary"></i>

<h2 class="mt-3">
<?php echo $patients; ?>
</h2>

<p>Total Patients</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card stat-card">

<div class="card-body text-center">

<i class="bi bi-heart-pulse text-success"></i>

<h2 class="mt-3">
<?php echo $doctors; ?>
</h2>

<p>Total Doctors</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card stat-card">

<div class="card-body text-center">

<i class="bi bi-file-earmark-medical text-danger"></i>

<h2 class="mt-3">
<?php echo $reports; ?>
</h2>

<p>Total Reports</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card stat-card">

<div class="card-body text-center">

<i class="bi bi-calendar-check text-warning"></i>

<h2 class="mt-3">
<?php echo $appointments; ?>
</h2>

<p>Appointments</p>

</div>

</div>

</div>

</div>

<br>

<div class="row">

<div class="col-md-6">

<div class="card quick-card">

<div class="card-body">

<h4>
Quick Actions
</h4>

<hr>

<a href="add_doctor.php"
class="btn btn-primary">

Add Doctor

</a>

<a href="upload_report.php"
class="btn btn-success">

Upload Report

</a>

<a href="appointments.php"
class="btn btn-warning">

Appointments

</a>

</div>

</div>

</div>

<div class="col-md-6">

<div class="card quick-card">

<div class="card-body">

<h4>
System Overview
</h4>

<hr>

<p>
Manage healthcare operations,
patients, doctors, reports,
AI analysis and QR verification.
</p>

</div>

</div>

</div>

</div>

</div>

</body>
</html>

