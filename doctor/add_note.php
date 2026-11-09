<?php

session_start();

include("../config/database.php");
include("../includes/notification_helper.php");

if(!isset($_SESSION['doctor_id']))
{
    header("Location: doctor_login.php");
    exit();
}

if(!isset($_GET['report_id']))
{
    die("Please open this page from Patient Reports.");
}

$report_id = $_GET['report_id'];

$report_query = mysqli_query(
$conn,
"SELECT tr.*,u.full_name
FROM test_reports tr
JOIN users u
ON tr.user_id=u.user_id
WHERE tr.report_id='$report_id'"
);

$report = mysqli_fetch_assoc($report_query);

if(!$report)
{
    die("Report Not Found");
}

if(isset($_POST['save']))
{
    $doctor_id = $_SESSION['doctor_id'];

    $notes = mysqli_real_escape_string(
        $conn,
        $_POST['notes']
    );

    $insert = mysqli_query(
    $conn,
    "INSERT INTO doctor_notes
    (
        doctor_id,
        user_id,
        report_id,
        notes
    )
    VALUES
    (
        '$doctor_id',
        '".$report['user_id']."',
        '$report_id',
        '$notes'
    )"
    );

    if($insert)
    {
        createNotification(
        $conn,
        $report['user_id'],
        "Doctor Notes Added",
        "Doctor has added observations on your ".$report['test_name']." report."
        );

        echo "<script>
        alert('Doctor Note Saved Successfully');
        window.location='patient_reports.php';
        </script>";
        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Add Doctor Notes</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container py-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>Add Doctor Notes</h3>

</div>

<div class="card-body">

<h5>
Patient:
<?php echo $report['full_name']; ?>
</h5>

<p>
Test:
<?php echo $report['test_name']; ?>
</p>

<form method="POST">

<textarea
name="notes"
class="form-control"
rows="8"
placeholder="Enter doctor observations..."
required></textarea>

<br>

<button
name="save"
class="btn btn-success">

Save Notes

</button>

<a
href="patient_reports.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</body>

</html>
```
