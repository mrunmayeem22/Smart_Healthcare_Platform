<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../config/database.php");

include("../config/database.php");

$patients = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"));
$doctors = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM doctors"));
$reports = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM test_reports"));
$prescriptions = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM prescriptions"));

?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Analytics Dashboard</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
padding:20px;
}

.card{
width:220px;
display:inline-block;
background:white;
padding:20px;
margin:10px;
text-align:center;
box-shadow:0px 0px 10px #ccc;
border-radius:10px;
}

.card h2{
color:#007bff;
}

table{
width:100%;
background:white;
border-collapse:collapse;
margin-top:20px;
}

table th,
table td{
border:1px solid #ddd;
padding:10px;
}

h1{
margin-bottom:20px;
}

</style>

</head>

<body>

<h1>Analytics Dashboard</h1>

<div class="card">
<h2><?php echo $patients; ?></h2>
Patients
</div>

<div class="card">
<h2><?php echo $doctors; ?></h2>
Doctors
</div>

<div class="card">
<h2><?php echo $reports; ?></h2>
Reports
</div>

<div class="card">
<h2><?php echo $prescriptions; ?></h2>
Prescriptions
</div>

<h2>Recent Reports</h2>

<table>

<tr>
<th>ID</th>
<th>Test Name</th>
<th>Date</th>
</tr>

<?php

$recentReports =
mysqli_query(
$conn,
"SELECT * FROM test_reports
ORDER BY report_id DESC
LIMIT 5"
);

while($row=mysqli_fetch_assoc($recentReports))
{
?>

<tr>

<td><?php echo $row['report_id']; ?></td>

<td><?php echo $row['test_name']; ?></td>

<td><?php echo $row['report_date']; ?></td>

</tr>

<?php
}
?>

</table>

<h2>Recent Prescriptions</h2>

<table>

<tr>

<th>ID</th>

<th>Medicine</th>

<th>Date</th>

</tr>

<?php

$recentPrescriptions =
mysqli_query(
$conn,
"SELECT * FROM prescriptions
ORDER BY prescription_id DESC
LIMIT 5"
);

while($row=mysqli_fetch_assoc($recentPrescriptions))
{
?>

<tr>

<td><?php echo $row['prescription_id']; ?></td>

<td><?php echo $row['medicine_name']; ?></td>

<td><?php echo $row['created_at']; ?></td>

</tr>

<?php
}
?>

</table>

</body>

</html>