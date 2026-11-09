<?php

session_start();

if(!isset($_SESSION['doctor_id']))
{
    header("Location: doctor_login.php");
    exit();
}

include("../config/database.php");

$report_id = $_GET['id'];

$query = "
SELECT tr.*, u.full_name
FROM test_reports tr
JOIN users u
ON tr.user_id = u.user_id
WHERE tr.report_id = '$report_id'
";

$result = mysqli_query($conn,$query);

$report = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>
<title>View Report</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<h2>Patient Report Details</h2>

<hr>

<p>
<strong>Patient Name:</strong>
<?php echo $report['full_name']; ?>
</p>

<p>
<strong>Test Name:</strong>
<?php echo $report['test_name']; ?>
</p>

<p>
<strong>Report Date:</strong>
<?php echo $report['report_date']; ?>
</p>

<p>
<strong>Status:</strong>
<?php echo $report['status']; ?>
</p>

<p>
<strong>Report File:</strong>
<?php echo $report['report_file']; ?>
</p>

<hr>

<a href="add_note.php?id=<?php echo $report['report_id']; ?>">
Add Doctor Note
</a>

<br><br>

<a href="patient_reports.php">
Back To Reports
</a>

</body>
</html>