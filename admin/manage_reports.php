<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../config/database.php");
$query = "
SELECT
tr.*,
u.full_name
FROM test_reports tr

JOIN users u
ON tr.user_id = u.user_id

ORDER BY report_id DESC
";

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Reports</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include("admin_header.php"); ?>
<div class="container py-4">
<div class="page-header">
<h2>📄 Medical Reports</h2>
<p>View uploaded reports.</p>
</div>
<div class="card content-card">
<div class="card-body">
    <div class="table-responsive">
<table class="table table-hover">
<tr>
<th>ID</th>
<th>Patient</th>
<th>Test</th>
<th>Date</th>
<th>Status</th>
<th>Report</th>
</tr>
<?php while($row=mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?=$row['report_id'];?></td>
<td><?=$row['full_name'];?></td>
<td><?=$row['test_name'];?></td>
<td><?=$row['report_date'];?></td>
<td>
<span class="badge bg-success">
<?=$row['status'];?>
</span>
</td>
<td>
<a
href="../assets/uploads/reports/<?=$row['report_file'];?>"
target="_blank"
class="btn btn-primary btn-sm">
View PDF
</a>
</td>
</tr>
<?php } ?>
</table>
</div>
</div>
</div>
</body>
</html>