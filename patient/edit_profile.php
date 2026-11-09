<?php

session_start();

include("../config/database.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$success = "";

if(isset($_POST['update']))
{
    $full_name = $_POST['full_name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    mysqli_query(
    $conn,
    "UPDATE users
    SET
    full_name='$full_name',
    mobile='$mobile',
    address='$address'
    WHERE user_id='$user_id'"
    );

    $success = "Profile Updated Successfully";
}

$user = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT * FROM users
WHERE user_id='$user_id'"
)
);

?>

<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Edit Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f4f7fb;
}

.profile-header{
    background:linear-gradient(135deg,#2563eb,#06b6d4);
    color:white;
    padding:30px;
    border-radius:20px;
    margin-bottom:25px;
}

.profile-card{
    border:none;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.profile-icon{
    font-size:80px;
    color:#2563eb;
}

.form-control{
    border-radius:12px;
    padding:12px;
}

</style>

</head>

<body>

<div class="container py-4">

<div class="profile-header">

<h2>
<i class="bi bi-person-gear"></i>
 Edit Profile
</h2>

<p class="mb-0">
Update your personal information and healthcare account details.
</p>

</div>

<?php
if($success!="")
{
?>
<div class="alert alert-success">
<?php echo $success; ?>
</div>
<?php
}
?>

<div class="card profile-card">

<div class="card-body p-4">

<div class="text-center mb-4">

<i class="bi bi-person-circle profile-icon"></i>

<h3 class="mt-3">

<?php echo $user['full_name']; ?>

</h3>

<p class="text-muted">

Patient Account

</p>

</div>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Full Name

</label>

<input
type="text"
name="full_name"
class="form-control"
value="<?php echo $user['full_name']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">

Mobile Number

</label>

<input
type="text"
name="mobile"
class="form-control"
value="<?php echo $user['mobile']; ?>"
required>

</div>

<div class="mb-4">

<label class="form-label">

Address

</label>

<textarea
name="address"
class="form-control"
rows="4"
required><?php echo $user['address']; ?></textarea>

</div>

<button
type="submit"
name="update"
class="btn btn-primary">

<i class="bi bi-save"></i>

 Update Profile

</button>

<a
href="profile.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

 Back

</a>

</form>

</div>

</div>

</div>

</body>

</html>

