<?php

session_start();

if(!isset($_SESSION['doctor_id']))
{
    header("Location: doctor_login.php");
    exit();
}

include("../config/database.php");
include("../includes/notification_helper.php");

/* APPROVE APPOINTMENT */

if(isset($_GET['approve']))
{
    $appointment_id = $_GET['approve'];

    $appointment = mysqli_fetch_assoc(
    mysqli_query(
    $conn,
    "SELECT * FROM appointments
     WHERE appointment_id='$appointment_id'")
    );

    mysqli_query(
    $conn,
    "UPDATE appointments
     SET approval_status='Approved'
     WHERE appointment_id='$appointment_id'"
    );

    createNotification(
    $conn,
    $appointment['user_id'],
    "Appointment Approved",
    "Your appointment for ".$appointment['test_name']." has been approved."
    );

    header("Location: appointments.php");
    exit();
}

/* REJECT APPOINTMENT */

if(isset($_GET['reject']))
{
    $appointment_id = $_GET['reject'];

    $appointment = mysqli_fetch_assoc(
    mysqli_query(
    $conn,
    "SELECT * FROM appointments
     WHERE appointment_id='$appointment_id'")
    );

    mysqli_query(
    $conn,
    "UPDATE appointments
     SET approval_status='Rejected'
     WHERE appointment_id='$appointment_id'"
    );

    createNotification(
    $conn,
    $appointment['user_id'],
    "Appointment Rejected",
    "Your appointment for ".$appointment['test_name']." has been rejected."
    );

    header("Location: appointments.php");
    exit();
}

/* LOAD APPOINTMENTS */

$result = mysqli_query(
$conn,
"SELECT a.*,u.full_name
FROM appointments a
JOIN users u
ON a.user_id=u.user_id
ORDER BY appointment_date ASC"
);

?>

<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Appointments</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
background:#f4f7fb;
}

.header-card{
background:linear-gradient(135deg,#059669,#0ea5e9);
color:white;
padding:25px;
border-radius:20px;
margin-bottom:25px;
}

.table-card{
border:none;
border-radius:20px;
box-shadow:0px 5px 20px rgba(0,0,0,.08);
}

.table th{
background:#0f172a;
color:white;
}

</style>

</head>

<body>

<div class="container py-4">

<div class="header-card">

<h2>
<i class="bi bi-calendar-check"></i>
 Patient Appointments
</h2>

<p class="mb-0">
Approve, reject and manage patient appointments.
</p>

</div>

<div class="card table-card">

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead>

<tr>

<th>Patient</th>
<th>Test</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)) { ?>

<tr>

<td>
<?php echo $row['full_name']; ?>
</td>

<td>
<?php echo $row['test_name']; ?>
</td>

<td>
<?php echo $row['appointment_date']; ?>
</td>

<td>
<?php echo $row['appointment_time']; ?>
</td>

<td>

<?php

$status = isset($row['approval_status'])
? $row['approval_status']
: 'Pending';

if($status=="Approved")
{
    echo "<span class='badge bg-success'>Approved</span>";
}
elseif($status=="Rejected")
{
    echo "<span class='badge bg-danger'>Rejected</span>";
}
else
{
    echo "<span class='badge bg-warning text-dark'>Pending</span>";
}

?>

</td>

<td>

<?php if($status=="Pending") { ?>

<a
href="appointments.php?approve=<?php echo $row['appointment_id']; ?>"
class="btn btn-success btn-sm">

Approve

</a>

<a
href="appointments.php?reject=<?php echo $row['appointment_id']; ?>"
class="btn btn-danger btn-sm">

Reject

</a>

<?php } else { ?>

<span class="text-muted">
Action Completed
</span>

<?php } ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<a
href="dashboard.php"
class="btn btn-secondary">

Back To Dashboard

</a>

</div>

</div>

</div>

</body>

</html>
