<?php

session_start();

include("../config/database.php");

$user_id = $_SESSION['user_id'];

$result = mysqli_query(
$conn,
"SELECT *
FROM appointments
WHERE user_id='$user_id'
ORDER BY appointment_date DESC"
);

?>
<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Appointments</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f4f7fb;">

<div class="container py-4">

<div class="card shadow border-0 rounded-4">

<div class="card-header bg-primary text-white">

<h3>📅 Appointment History</h3>

</div>

<div class="card-body">
<div class="table-responsive">
<table class="table table-hover">

<tr>

<th>Test</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)) { ?>

<tr>

<td><?php echo $row['test_name']; ?></td>

<td><?php echo $row['appointment_date']; ?></td>

<td><?php echo $row['appointment_time']; ?></td>

<td>

<?php

if($row['status']=="Pending")
{
echo "<span class='badge bg-warning'>Pending</span>";
}
else
{
echo "<span class='badge bg-success'>".$row['status']."</span>";
}

?>

</td>

</tr>

<?php } ?>

</table>

<a
href="book_appointment.php"
class="btn btn-primary">

Book Appointment

</a>

</div>

</div>

</div>

</body>

</html>

