<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../config/database.php");
include("../includes/notification_helper.php");

$success = "";

if(isset($_POST['upload']))
{
    $user_id = $_POST['user_id'];
    $test_name = $_POST['test_name'];
    $report_date = $_POST['report_date'];

    $file_name = $_FILES['report_file']['name'];
    $tmp_name = $_FILES['report_file']['tmp_name'];

    move_uploaded_file(
        $tmp_name,
        "../assets/uploads/reports/".$file_name
    );

    $query = "
    INSERT INTO test_reports
    (
        user_id,
        test_name,
        report_file,
        report_date,
        status
    )
    VALUES
    (
        '$user_id',
        '$test_name',
        '$file_name',
        '$report_date',
        'Completed'
    )";

    if(mysqli_query($conn,$query))
    {
        createNotification(
            $conn,
            $user_id,
            "Report Uploaded",
            "Your ".$test_name." report has been uploaded successfully."
        );

        $success = "Report Uploaded Successfully";
    }
}

$users = mysqli_query(
$conn,
"SELECT * FROM users ORDER BY full_name"
);

?>

<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Upload Medical Report</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f4f7fb;
}

.page-header{
    background:linear-gradient(135deg,#2563eb,#06b6d4);
    color:white;
    padding:25px;
    border-radius:20px;
    margin-bottom:25px;
}

.content-card{
    border:none;
    border-radius:20px;
    box-shadow:0 4px 15px rgba(0,0,0,.08);
}

</style>

</head>

<body>

<?php include("admin_header.php"); ?>

<div class="container py-4">

<div class="page-header">

<h2>

📤 Upload Medical Report

</h2>

<p class="mb-0">

Upload laboratory reports for registered patients.

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

<div class="card content-card">

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">

<label class="form-label">

Patient

</label>

<select
name="user_id"
class="form-select"
required>

<option value="">

Select Patient

</option>

<?php
while($user=mysqli_fetch_assoc($users))
{
?>

<option value="<?php echo $user['user_id']; ?>">

<?php echo $user['full_name']; ?>

</option>

<?php
}
?>

</select>

</div>

<div class="mb-3">

<label class="form-label">

Test Name

</label>

<input
type="text"
name="test_name"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

Report Date

</label>

<input
type="date"
name="report_date"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

Upload PDF Report

</label>

<input
type="file"
name="report_file"
class="form-control"
accept=".pdf"
required>

</div>

<button
type="submit"
name="upload"
class="btn btn-primary">

<i class="bi bi-upload"></i>

 Upload Report

</button>

<a
href="dashboard.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</body>

</html>
