<?php

session_start();

if(!isset($_SESSION['doctor_id']))
{
    header("Location: doctor_login.php");
    exit();
}

include("../config/database.php");

$result = mysqli_query(
$conn,
"SELECT p.*,u.full_name
FROM prescriptions p
JOIN users u
ON p.user_id=u.user_id
ORDER BY prescription_id DESC"
);
include("../includes/notification_helper.php");

?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Prescriptions</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
background:#f4f7fb;
}

.header-card{
background:linear-gradient(135deg,#2563eb,#06b6d4);
color:white;
padding:25px;
border-radius:20px;
margin-bottom:25px;
}

.prescription-card{
border:none;
border-radius:20px;
box-shadow:0px 5px 20px rgba(0,0,0,.08);
}

</style>

</head>

<body>

<div class="container py-4">

<div class="header-card">

<h2>
<i class="bi bi-capsule-pill"></i>
 Prescriptions
</h2>

<p class="mb-0">
Manage patient medications and treatment plans.
</p>

</div>

<div class="card prescription-card">

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover">

<tr>

<th>ID</th>
<th>Patient</th>
<th>Medicine</th>
<th>Dosage</th>
<th>Date</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{
?>

<tr>

<td>
<?php echo $row['prescription_id']; ?>
</td>

<td>
<?php echo $row['full_name']; ?>
</td>

<td>
<?php echo $row['medicine_name']; ?>
</td>

<td>
<?php echo $row['dosage']; ?>
</td>

<td>
<?php echo $row['created_at']; ?>
</td>

</tr>

<?php
}
?>

</table>

</div>

<a href="dashboard.php"
class="btn btn-secondary">

Back To Dashboard

</a>

</div>

</div>

</div>

</body>

</html>

