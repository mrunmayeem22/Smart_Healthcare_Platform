<?php

session_start();

if(!isset($_SESSION['doctor_id']))
{
    header("Location: doctor_login.php");
    exit();
}

include("../config/database.php");

$query = "
SELECT
tr.*,
u.full_name
FROM test_reports tr

LEFT JOIN users u
ON tr.user_id = u.user_id

ORDER BY tr.report_id DESC
";

$result = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html>

<head>

<title>Patient Reports</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f4f7fb;
}

.header-card{
    background:linear-gradient(135deg,#059669,#0ea5e9);
    color:white;
    border-radius:20px;
    padding:25px;
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

.btn-action{
    margin:2px;
}

</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<div class="container py-4">

<div class="header-card">

<h2>
<i class="bi bi-file-earmark-medical"></i>
 Patient Reports
</h2>

<p class="mb-0">
Review reports, add notes and create prescriptions.
</p>

</div>

<div class="card table-card">

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-hover align-middle">

<tr>

<th>Report ID</th>
<th>Patient Name</th>
<th>Test Name</th>
<th>Date</th>
<th>Report</th>
<th>Notes</th>
<th>Prescription</th>

</tr>

<?php

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
?>

<tr>

<td>
<?php echo $row['report_id']; ?>
</td>

<td>
<?php echo $row['full_name']; ?>
</td>

<td>
<?php echo $row['test_name']; ?>
</td>

<td>
<?php echo $row['report_date']; ?>
</td>

<td>

<a
href="../assets/uploads/reports/<?php echo $row['report_file']; ?>"
target="_blank"
class="btn btn-primary btn-sm btn-action">

<i class="bi bi-eye"></i>
 View

</a>

</td>

<td>

<a
href="add_note.php?report_id=<?php echo $row['report_id']; ?>"
class="btn btn-success btn-sm btn-action">

<i class="bi bi-journal-medical"></i>
 Add Notes

</a>

</td>

<td>

<a
href="prescriptions.php?report_id=<?php echo $row['report_id']; ?>"
class="btn btn-warning btn-sm btn-action">

<i class="bi bi-capsule-pill"></i>
 Prescription

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

<td colspan="7" class="text-center text-danger">

No Reports Found

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

