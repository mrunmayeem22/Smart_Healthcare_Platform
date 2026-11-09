<?php

session_start();

include("../config/database.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$message = "";

if(isset($_POST['book']))
{
    $user_id = $_SESSION['user_id'];

    $test_name = $_POST['test_name'];
    $appointment_date = $_POST['appointment_date'];
    $selected_date = "";

if(isset($_POST['appointment_date']))
{
    $selected_date = $_POST['appointment_date'];
}
$slots = mysqli_query(
$conn,
"SELECT *
FROM appointment_slots
WHERE slot_id NOT IN
(
    SELECT slot_id
    FROM appointments
    WHERE appointment_date='$selected_date'
)"
);
   $slot_id=$_POST['slot_id'];
   $slot=mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT * FROM appointment_slots
WHERE slot_id='$slot_id'"
)
);

$appointment_time=$slot['slot_time'];

    $query = "
    INSERT INTO appointments
    (
        user_id,
        test_name,
        appointment_date,
        appointment_time
    )
    VALUES
    (
        '$user_id',
        '$test_name',
        '$appointment_date',
        '$appointment_time'
    )";

    if(mysqli_query($conn,$query))
    {
        $message = "Appointment Booked Successfully";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Book Appointment</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f4f7fb;
}

.header-box{
    background:linear-gradient(135deg,#2563eb,#06b6d4);
    color:white;
    padding:30px;
    border-radius:25px;
    margin-bottom:25px;
}

.appointment-card{
    border:none;
    border-radius:25px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.icon-circle{
    width:90px;
    height:90px;
    border-radius:50%;
    background:#e0f2fe;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:40px;
    color:#2563eb;
    margin:auto;
}

.form-control,
.form-select{
    height:50px;
    border-radius:12px;
}

.btn-book{
    border-radius:12px;
    padding:12px 30px;
}

</style>

</head>

<body>

<div class="container py-5">

<div class="header-box">

<h2>
📅 Book Appointment
</h2>

<p class="mb-0">
Schedule your laboratory test appointment quickly and easily.
</p>

</div>

<div class="card appointment-card">

<div class="card-body p-5">

<div class="text-center mb-4">

<div class="icon-circle">

<i class="bi bi-calendar-check"></i>

</div>

<h3 class="mt-3">

Appointment Booking

</h3>

<p class="text-muted">

Choose a test, date and preferred time slot.

</p>

</div>

<?php
if($message!="")
{
?>

<div class="alert alert-success">

<?php echo $message; ?>

</div>

<?php
}
?>
<form method="POST">
<div class="mb-3">
<label class="form-label">
Test Name
</label>
<select
name="test_name"
class="form-select"
required>
<option value="">

Select Test

</option>
<option>CBC Test</option>
<option>Blood Sugar Test</option>
<option>Vitamin D Test</option>
<option>Lipid Profile</option>
<option>Thyroid Test</option>
<option>Liver Function Test</option>
<option>Kidney Function Test</option>
<option>Urine Analysis</option>
</select>
</div>
<div class="row">
<div class="col-md-6">
<div class="mb-3">
<label class="form-label">
Appointment Date
</label>
<input
type="date"
name="appointment_date"
class="form-control"
required>
</div>
</div>
<div class="col-md-6">
<div class="mb-3">
<label class="form-label">
Appointment Time
</label>
<label>Select Slot</label>

<select
name="slot_id"
class="form-select"
required>

<option value="">
Select Slot
</option>

<?php

$slots = mysqli_query(
$conn,
"SELECT *
FROM appointment_slots
WHERE slot_id NOT IN
(
SELECT slot_id
FROM appointments
WHERE appointment_date='$selected_date'
)"
);

while($slot=mysqli_fetch_assoc($slots))
{
?>

<option value="<?php echo $slot['slot_id']; ?>">

<?php echo $slot['slot_time']; ?>

</option>

<?php
}
?>

</select>
</div>
</div>
</div>
<div class="text-center mt-4">
<button
type="submit"
name="book"
class="btn btn-primary btn-book">
<i class="bi bi-calendar-plus"></i>
 Book Appointment
</button>
<a
href="dashboard.php"
class="btn btn-secondary btn-book">
<i class="bi bi-arrow-left"></i>
 Dashboard
</a>
</div>
</form>
</div>
</div>
</div>
</body>
</html>