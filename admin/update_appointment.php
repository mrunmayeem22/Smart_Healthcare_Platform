<?php

session_start();

include("../config/database.php");

if(!isset($_SESSION['doctor_id']))
{
    header("Location: doctor_login.php");
    exit();
}

$id = $_GET['id'];

if(isset($_POST['update']))
{
    $status = $_POST['status'];

    mysqli_query(
    $conn,
    "UPDATE appointments
     SET status='$status'
     WHERE appointment_id='$id'"
    );

    echo "<script>
    alert('Appointment Updated Successfully');
    window.location='appointments.php';
    </script>";
}

$result = mysqli_query(
$conn,
"SELECT a.*,u.full_name
FROM appointments a
JOIN users u
ON a.user_id=u.user_id
WHERE a.appointment_id='$id'"
);

$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Update Appointment</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f4f7fb;
}

.header-box{
    background:linear-gradient(135deg,#059669,#0ea5e9);
    color:white;
    padding:25px;
    border-radius:20px;
    margin-bottom:25px;
}

.content-card{
    border:none;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.info-box{
    background:#f8fafc;
    padding:15px;
    border-radius:12px;
    margin-bottom:20px;
}

</style>

</head>

<body>

<div class="container py-4">

<div class="header-box">

<h2>
<i class="bi bi-calendar2-check"></i>
 Update Appointment
</h2>

<p class="mb-0">
Manage patient appointment status and scheduling.
</p>

</div>

<div class="card content-card">

<div class="card-body p-4">

<div class="info-box">

<h5>
Patient:
<strong>
<?php echo $row['full_name']; ?>
</strong>
</h5>

<p class="mb-1">
Test:
<strong>
<?php echo $row['test_name']; ?>
</strong>
</p>

<p class="mb-1">
Date:
<strong>
<?php echo $row['appointment_date']; ?>
</strong>
</p>

<p class="mb-0">
Time:
<strong>
<?php echo $row['appointment_time']; ?>
</strong>
</p>

</div>

<form method="POST">

<div class="mb-4">

<label class="form-label">

Appointment Status

</label>

<select
name="status"
class="form-select"
required>

<option value="Pending"
<?php if($row['status']=="Pending") echo "selected"; ?>>
Pending
</option>

<option value="Confirmed"
<?php if($row['status']=="Confirmed") echo "selected"; ?>>
Confirmed
</option>

<option value="Completed"
<?php if($row['status']=="Completed") echo "selected"; ?>>
Completed
</option>

<option value="Cancelled"
<?php if($row['status']=="Cancelled") echo "selected"; ?>>
Cancelled
</option>

</select>

</div>

<button
type="submit"
name="update"
class="btn btn-success">

<i class="bi bi-check-circle"></i>

 Update Status

</button>

<a
href="appointments.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

 Back

</a>

</form>

</div>

</div>

</div>

</body>

</html>
