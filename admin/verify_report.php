<?php

include("config/database.php");

if(!isset($_GET['report_id']))
{
    die("Invalid QR");
}

$report_id = $_GET['report_id'];

$query = mysqli_query(
$conn,
"SELECT tr.*,
u.full_name

FROM test_reports tr

JOIN users u
ON tr.user_id=u.user_id

WHERE tr.report_id='$report_id'"
);

$report = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Report Verification</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container py-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>✓ Report Verified</h3>

</div>

<div class="card-body">

<p>

<strong>Patient:</strong>

<?php echo $report['full_name']; ?>

</p>

<p>

<strong>Test Name:</strong>

<?php echo $report['test_name']; ?>

</p>

<p>

<strong>Date:</strong>

<?php echo $report['report_date']; ?>

</p>

<p>

<strong>Status:</strong>

<?php echo $report['status']; ?>

</p>

<p>

<strong>Report ID:</strong>

<?php echo $report['report_id']; ?>

</p>

</div>

</div>

</div>

</body>

</html>