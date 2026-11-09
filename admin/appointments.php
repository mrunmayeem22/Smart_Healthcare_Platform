<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../config/database.php");

$result =
mysqli_query(
$conn,
"SELECT
a.*,
u.full_name
FROM appointments a
JOIN users u
ON a.user_id=u.user_id
ORDER BY appointment_id DESC"
);

?>
<!DOCTYPE html>
<html>
<head>
<title>Appointments</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include("admin_header.php"); ?>
<div class="container py-4">
<div class="page-header">
<h2>📅 Appointment Management</h2>
<p>Manage patient appointments.</p>
</div>
<div class="card content-card">
<div class="card-body">
    <div class="table-responsive">
<table class="table table-hover">
<tr>

<th>Patient</th>
<th>Test</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>
<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)) { ?>

<tr>
<td><?= $row['full_name']; ?></td>
<td><?= $row['test_name']; ?></td>
<td><?= $row['appointment_date']; ?></td>
<td><?= $row['appointment_time']; ?></td>
<td>
<?php

if($row['status']=="Pending")
{
    echo "<span class='badge bg-warning'>Pending</span>";
}
elseif($row['status']=="Completed")
{
    echo "<span class='badge bg-success'>Completed</span>";
}
else
{
    echo "<span class='badge bg-primary'>".$row['status']."</span>";
}
?>
</td>
<td>
<a
href="update_appointment.php?id=<?=$row['appointment_id'];?>"
class="btn btn-sm btn-primary">
Update
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