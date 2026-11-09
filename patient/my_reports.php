<?php

session_start();

include("../config/database.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = mysqli_query(
$conn,
"SELECT *
FROM test_reports
WHERE user_id='$user_id'
ORDER BY report_id DESC"
);

$total_reports = mysqli_num_rows($query);

?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Reports</title>

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

.report-card{
    border:none;
    border-radius:25px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.table th{
    background:#0f172a;
    color:white;
}

.stat-card{
    border:none;
    border-radius:20px;
    box-shadow:0 4px 15px rgba(0,0,0,.08);
}

</style>

</head>

<body>

<div class="container py-4">

<div class="header-box">

<h2>

📄 My Medical Reports

</h2>

<p class="mb-0">

Access your uploaded laboratory reports and QR verification.

</p>

</div>

<div class="row mb-4">

<div class="col-md-4">

<div class="card stat-card">

<div class="card-body text-center">

<h3>

<?php echo $total_reports; ?>

</h3>

<p class="mb-0">

Total Reports

</p>

</div>

</div>

</div>

</div>

<div class="card report-card">

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover align-middle">

<tr>

<th>Report ID</th>
<th>Test Name</th>
<th>Date</th>
<th>Status</th>
<th>Report</th>
<th>QR</th>

</tr>

<?php

mysqli_data_seek($query,0);

if(mysqli_num_rows($query)>0)
{
    while($row=mysqli_fetch_assoc($query))
    {
?>

<tr>

<td>

<?php echo $row['report_id']; ?>

</td>

<td>

<?php echo $row['test_name']; ?>

</td>

<td>

<?php echo $row['report_date']; ?>

</td>

<td>

<?php

if($row['status']=="Completed")
{
    echo "<span class='badge bg-success'>Completed</span>";
}
elseif($row['status']=="Pending")
{
    echo "<span class='badge bg-warning'>Pending</span>";
}
else
{
    echo "<span class='badge bg-primary'>".$row['status']."</span>";
}

?>

</td>

<td>

<a
href="../assets/uploads/reports/<?php echo $row['report_file']; ?>"
target="_blank"
class="btn btn-primary btn-sm">

<i class="bi bi-file-earmark-pdf"></i>

 View PDF

</a>

</td>

<td>

<a
href="../assets/qr/report_<?php echo $row['report_id']; ?>.png"
target="_blank"
class="btn btn-success btn-sm">

<i class="bi bi-qr-code"></i>

 QR

</a>
</td>
</tr>

<?php
    }
}
else
{
?>

<tr>

<td colspan="6" class="text-center text-danger">

No Reports Available

</td>

</tr>

<?php
}
?>

</table>

</div>

<br>

<a
href="dashboard.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

 Back To Dashboard

</a>

</div>

</div>

</div>

</body>

</html>

