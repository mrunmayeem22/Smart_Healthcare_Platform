<?php

session_start();

include("../config/database.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$reports = mysqli_query(
$conn,
"SELECT *
FROM test_reports
WHERE user_id='$user_id'
ORDER BY report_date DESC"
);

$notes = mysqli_query(
$conn,
"SELECT *
FROM doctor_notes
WHERE user_id='$user_id'
ORDER BY created_at DESC"
);

$prescriptions = mysqli_query(
$conn,
"SELECT *
FROM prescriptions
WHERE user_id='$user_id'
ORDER BY created_at DESC"
);

?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Health History</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f7fb;
}

.history-card{
    border:none;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.page-header{
    background:linear-gradient(135deg,#2563eb,#06b6d4);
    color:white;
    padding:25px;
    border-radius:20px;
    margin-bottom:25px;
}

</style>

</head>

<body>

<div class="container py-4">

<div class="page-header">

<h2>🩺 Health History</h2>

<p class="mb-0">
Your complete medical timeline
</p>

</div>

<!-- REPORTS -->

<div class="card history-card mb-4">

<div class="card-header bg-primary text-white">

📄 Reports

</div>

<div class="card-body">

<?php

if(mysqli_num_rows($reports)>0)
{
    while($report=mysqli_fetch_assoc($reports))
    {
?>

<div class="border-bottom pb-2 mb-2">

<strong>
<?php echo $report['test_name']; ?>
</strong>

<br>

<small class="text-muted">

<?php echo $report['report_date']; ?>

</small>

</div>

<?php
    }
}
else
{
    echo "<p class='text-muted'>No reports available.</p>";
}
?>

</div>

</div>

<!-- DOCTOR NOTES -->

<div class="card history-card mb-4">

<div class="card-header bg-success text-white">

📝 Doctor Notes

</div>

<div class="card-body">

<?php

if(mysqli_num_rows($notes)>0)
{
    while($note=mysqli_fetch_assoc($notes))
    {
?>

<div class="border-bottom pb-2 mb-2">

<?php echo $note['notes']; ?>

<br>

<small class="text-muted">

<?php echo $note['created_at']; ?>

</small>

</div>

<?php
    }
}
else
{
    echo "<p class='text-muted'>No doctor notes available.</p>";
}
?>

</div>

</div>

<!-- PRESCRIPTIONS -->

<div class="card history-card">

<div class="card-header bg-warning">

💊 Prescriptions

</div>

<div class="card-body">

<?php

if(mysqli_num_rows($prescriptions)>0)
{
    while($pres=mysqli_fetch_assoc($prescriptions))
    {
?>

<div class="border-bottom pb-2 mb-2">

<strong>

<?php echo $pres['medicine_name']; ?>

</strong>

<br>

Dosage:
<?php echo $pres['dosage']; ?>

</div>

<?php
    }
}
else
{
    echo "<p class='text-muted'>No prescriptions available.</p>";
}
?>

</div>

</div>

<br>

<a href="dashboard.php" class="btn btn-secondary">

← Back To Dashboard

</a>

</div>

</body>

</html>