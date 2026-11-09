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
"SELECT * FROM doctors
ORDER BY doctor_id DESC"
);

?>

<!DOCTYPE html>
<html>

<head>

<title>Manage Doctors</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<?php include("admin_header.php"); ?>

<div class="container py-4">

<div class="page-header">

<h2>👨‍⚕️ Manage Doctors</h2>

<p>View all registered doctors.</p>

</div>

<div class="card content-card">

<div class="card-body">
<div class="table-responsive">
<table class="table table-hover">

<tr>
<th>ID</th>
<th>Name</th>
<th>Specialization</th>
<th>Email</th>
<th>Mobile</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)) { ?>

<tr>

<td><?= $row['doctor_id']; ?></td>

<td><?= $row['doctor_name']; ?></td>

<td><?= $row['specialization']; ?></td>

<td><?= $row['email']; ?></td>

<td><?= $row['mobile']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>
</body>
</html>

