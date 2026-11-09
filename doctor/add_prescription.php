<?php

session_start();

include("../config/database.php");

if(!isset($_SESSION['doctor_id']))
{
    header("Location: doctor_login.php");
    exit();
}

include("../includes/notification_helper.php");

$doctor_id = $_SESSION['doctor_id'];

$success = "";

if(isset($_POST['save']))
{
    $user_id = $_POST['user_id'];
    $medicine_name = $_POST['medicine_name'];
    $dosage = $_POST['dosage'];
    $patient_condition = $_POST['patient_condition'];
    $remarks = $_POST['remarks'];

    $insert = mysqli_query(
    $conn,
    "INSERT INTO prescriptions
    (
        doctor_id,
        user_id,
        medicine_name,
        dosage,
        patient_condition,
        remarks
    )
    VALUES
    (
        '$doctor_id',
        '$user_id',
        '$medicine_name',
        '$dosage',
        '$patient_condition',
        '$remarks'
    )"
    );

    if($insert)
    {
        createNotification(
        $conn,
        $user_id,
        "Prescription Added",
        "Doctor has added a new prescription."
        );

        $success = "Prescription Added Successfully";
    }
}

$patients = mysqli_query(
$conn,
"SELECT * FROM users ORDER BY full_name"
);

?>

<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Create Prescription</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
background:#f4f7fb;
}

.header-box{
background:linear-gradient(135deg,#16a34a,#22c55e);
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

</style>

</head>

<body>

<div class="container py-4">

<div class="header-box">

<h2>
💊 Create Prescription
</h2>

<p class="mb-0">
Generate prescriptions for patients.
</p>

</div>

<?php
if($success!="")
{
?>
<div class="alert alert-success">
<?php echo $success; ?>
</div>
<?php
}
?>

<div class="card content-card">

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Patient</label>

<select
name="user_id"
class="form-select"
required>

<option value="">
Select Patient
</option>

<?php
while($patient=mysqli_fetch_assoc($patients))
{
?>

<option value="<?php echo $patient['user_id']; ?>">

<?php echo $patient['full_name']; ?>

</option>

<?php
}
?>

</select>

</div>

<div class="mb-3">

<label>Medicine Name</label>

<input
type="text"
name="medicine_name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Dosage</label>

<input
type="text"
name="dosage"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Patient Condition</label>

<textarea
name="patient_condition"
class="form-control"
rows="3"
required></textarea>

</div>

<div class="mb-3">

<label>Remarks</label>

<textarea
name="remarks"
class="form-control"
rows="4"></textarea>

</div>

<button
type="submit"
name="save"
class="btn btn-success">

<i class="bi bi-save"></i>

 Save Prescription

</button>

<a
href="dashboard.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</body>

</html>