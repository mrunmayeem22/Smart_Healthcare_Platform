<?php

session_start();

include("../config/database.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query(
$conn,
"SELECT dn.*, d.doctor_name
FROM doctor_notes dn
LEFT JOIN doctors d
ON dn.doctor_id = d.doctor_id
WHERE dn.user_id = '$user_id'
ORDER BY dn.created_at DESC"
);

?>

<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Doctor Notes History</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f4f7fb;
}

.header-box{
    background:linear-gradient(135deg,#0ea5e9,#2563eb);
    color:white;
    padding:25px;
    border-radius:20px;
    margin-bottom:25px;
}

.note-card{
    border:none;
    border-radius:20px;
    box-shadow:0px 5px 20px rgba(0,0,0,.08);
}

.note-icon{
    font-size:30px;
    color:#2563eb;
}

</style>

</head>

<body>

<div class="container py-4">

<div class="header-box">

<h2>
🩺 Doctor Notes History
</h2>

<p class="mb-0">
View all observations and notes added by doctors.
</p>

</div>

<?php

if(mysqli_num_rows($result) > 0)
{
    while($row=mysqli_fetch_assoc($result))
    {
?>

<div class="card note-card mb-4">

<div class="card-body">

<h5>

<i class="bi bi-person-badge note-icon"></i>

Doctor:
<?php echo $row['doctor_name']; ?>

</h5>

<hr>

<p>

<strong>Observation:</strong>

<br>

<?php echo nl2br($row['notes']); ?>

</p>

<p class="text-muted">

<i class="bi bi-calendar-event"></i>

<?php echo $row['created_at']; ?>

</p>

</div>

</div>

<?php
    }
}
else
{
?>

<div class="alert alert-info">

No doctor notes available.

</div>

<?php
}
?>

<a
href="dashboard.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

 Back To Dashboard

</a>

</div>

</body>

</html>

