<?php

session_start();

include("../config/database.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

mysqli_query(
$conn,
"UPDATE notifications
SET status='Read'
WHERE user_id='$user_id'"
);

$query = mysqli_query(
$conn,
"SELECT *
FROM notifications
WHERE user_id='$user_id'
ORDER BY notification_id DESC"
);

?>

<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Notifications</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f4f7fb;
}

.header-box{
    background:linear-gradient(135deg,#f59e0b,#f97316);
    color:white;
    padding:25px;
    border-radius:20px;
    margin-bottom:25px;
}

.notification-card{
    border:none;
    border-radius:20px;
    box-shadow:0 4px 15px rgba(0,0,0,.08);
    margin-bottom:15px;
}

.notification-icon{
    font-size:35px;
    color:#f59e0b;
}

.time-text{
    color:#6b7280;
    font-size:13px;
}

</style>

</head>

<body>

<div class="container py-4">

<div class="header-box">

<h2>

🔔 Notifications

</h2>

<p class="mb-0">

Stay updated with reports, appointments, prescriptions and doctor notes.

</p>

</div>

<?php

if(mysqli_num_rows($query) > 0)
{
    while($row = mysqli_fetch_assoc($query))
    {
?>

<div class="card notification-card">

<div class="card-body">

<div class="row align-items-center">

<div class="col-md-1 text-center">

<i class="bi bi-bell-fill notification-icon"></i>

</div>

<div class="col-md-11">

<h5>

<?php echo $row['title']; ?>

</h5>

<p class="mb-1">

<?php echo $row['message']; ?>

</p>

<span class="time-text">

<?php echo $row['created_at']; ?>

</span>

</div>

</div>

</div>

</div>

<?php
    }
}
else
{
?>

<div class="alert alert-info">

No notifications available.

</div>

<?php
}
?>

<a
href="dashboard.php"
class="btn btn-secondary mt-3">

<i class="bi bi-arrow-left"></i>

 Back To Dashboard

</a>

</div>

</body>

</html>