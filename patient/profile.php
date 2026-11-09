<?php

session_start();

include("../config/database.php");

$user_id = $_SESSION['user_id'];

$query = mysqli_query(
$conn,
"SELECT * FROM users
WHERE user_id='$user_id'"
);

$user = mysqli_fetch_assoc($query);

?>
<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f4f7fb;
}

.profile-header{
    background:linear-gradient(135deg,#2563eb,#06b6d4);
    color:white;
    border-radius:25px;
    padding:30px;
    margin-bottom:25px;
}

.profile-card{
    border:none;
    border-radius:25px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.profile-avatar{
    width:140px;
    height:140px;
    border-radius:50%;
    background:white;
    color:#2563eb;
    font-size:55px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
    margin-top:-70px;
    border:5px solid white;
}

.info-box{
    background:#f8fafc;
    border-radius:15px;
    padding:20px;
    margin-bottom:15px;
}

</style>

</head>

<body>

<div class="container py-5">

<div class="profile-header">

<h2>👤 Patient Profile</h2>

<p class="mb-0">

Manage your personal information and account settings

</p>

</div>

<div class="card profile-card">

<div class="card-body">

<div class="profile-avatar">

<i class="bi bi-person-fill"></i>

</div>

<div class="text-center mt-3">

<h2>

<?php echo $user['full_name']; ?>

</h2>

<p class="text-muted">

Patient ID:
<?php echo $user['user_id']; ?>

</p>

</div>

<hr>

<div class="row">

<div class="col-md-6">

<div class="info-box">

<h6>

<i class="bi bi-envelope-fill"></i>

 Email

</h6>

<p class="mb-0">

<?php echo $user['email']; ?>

</p>

</div>

</div>

<div class="col-md-6">

<div class="info-box">

<h6>

<i class="bi bi-telephone-fill"></i>

 Mobile

</h6>

<p class="mb-0">

<?php echo $user['mobile']; ?>

</p>

</div>

</div>

</div>

<div class="info-box">

<h6>

<i class="bi bi-geo-alt-fill"></i>

 Address

</h6>

<p class="mb-0">

<?php echo $user['address']; ?>

</p>

</div>

<div class="text-center mt-4">

<a
href="edit_profile.php"
class="btn btn-primary btn-lg">

<i class="bi bi-pencil-square"></i>

 Edit Profile

</a>

<a
href="change_password.php"
class="btn btn-warning btn-lg">

<i class="bi bi-lock-fill"></i>

 Change Password

</a>

<a
href="dashboard.php"
class="btn btn-secondary btn-lg">

<i class="bi bi-arrow-left"></i>

 Dashboard

</a>

</div>

</div>

</div>

</div>

</body>

</html>
