<?php

include("../config/database.php");

$report_id = $_GET['id'];

$query = "
SELECT
tr.*,
u.full_name
FROM test_reports tr

JOIN users u
ON tr.user_id=u.user_id

WHERE tr.report_id='$report_id'
";

$result = mysqli_query($conn,$query);

if(mysqli_num_rows($result)==0)
{
    die("Invalid Report");
}

$report = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Verify Report</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
padding:30px;
}

.card{
background:white;
padding:25px;
width:600px;
margin:auto;
box-shadow:0px 0px 10px #ccc;
}

.valid{
color:green;
font-size:24px;
font-weight:bold;
}

</style>

</head>

<body>

<div class="card">

<div class="valid">

✓ Report Verified Successfully

</div>

<hr>

<p>

<strong>Patient:</strong>

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

<strong>Report ID:</strong>

<?php echo $report['report_id']; ?>

</p>

</div>

</body>
</html>