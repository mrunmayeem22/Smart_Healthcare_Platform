<?php

session_start();

if(!isset($_SESSION['doctor_id']))
{
    header("Location: doctor_login.php");
    exit();
}

$name=$_SESSION['doctor_name'];

?>

<!DOCTYPE html>
<html>

<head>

<title>Doctor Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet"
href="../assets/css/doctor.css">

</head>

<body>

<div class="topbar d-flex justify-content-between">

<h4>👨‍⚕️ Doctor Portal</h4>

<a href="logout.php"
class="btn btn-danger">

Logout

</a>

</div>

<div class="container py-4">

<div class="welcome-card mb-4">

<h2>
Welcome <?php echo $name; ?>
</h2>

<p>
Manage patient appointments,
reports, notes and prescriptions.
</p>

</div>

<div class="row g-4">

<div class="col-lg-4 col-md-6 col-sm-12">

<div class="card dashboard-card">

<div class="card-body text-center">

<i class="bi bi-calendar-check"></i>

<h4 class="mt-3">
Appointments
</h4>

<p>
View scheduled appointments.
</p>

<a href="appointments.php"
class="btn btn-success">

Open

</a>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card dashboard-card">

<div class="card-body text-center">

<i class="bi bi-file-earmark-medical"></i>

<h4 class="mt-3">
Patient Reports
</h4>

<p>
Review patient reports.
</p>

<a href="patient_reports.php"
class="btn btn-success">

Open

</a>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card dashboard-card">

<div class="card-body text-center">

<i class="bi bi-capsule-pill"></i>

<h4 class="mt-3">
Create Prescription
</h4>

<p>
Generate prescriptions for patients.
</p>

<a
href="add_prescription.php"
class="btn btn-success">

Open

</a>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card dashboard-card">

<div class="card-body text-center">

<i class="bi bi-capsule-pill"></i>

<h4 class="mt-3">
Prescriptions
</h4>

<p>
Manage prescriptions.
</p>

<a href="prescriptions.php"
class="btn btn-primary">

Open

</a>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card dashboard-card">

<div class="card-body text-center">

<i class="bi bi-person-circle"></i>

<h4 class="mt-3">
Profile
</h4>

<p>
View doctor profile.
</p>

<a href="profile.php"
class="btn btn-primary">

Open

</a>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card dashboard-card">

<div class="card-body text-center">

<i class="bi bi-graph-up-arrow"></i>

<h4 class="mt-3">
Analytics
</h4>

<p>
Healthcare analytics.
</p>

<a href="../admin/analytics.php"
class="btn btn-primary">

Open

</a>

</div>

</div>

</div>

</div>

</div>

</body>
</html>