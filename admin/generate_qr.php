<?php

session_start();

include("../config/database.php");
include("../phpqrcode/qrlib.php");

$message = "";

if(isset($_POST['generate']))
{
    $report_id = $_POST['report_id'];

    $check = mysqli_query(
    $conn,
    "SELECT * FROM test_reports
     WHERE report_id='$report_id'"
    );

    if(mysqli_num_rows($check)>0)
    {
        $verify_url =
       $verify_url =
"http://192.168.1.15/SmartHealthcarePlatform/verify_report.php?report_id=".$report_id;

        $file_name =
        "report_".$report_id.".png";

        $file_path =
        "../assets/qr/".$file_name;

        QRcode::png(
            $verify_url,
            $file_path,
            QR_ECLEVEL_L,
            8
        );

        mysqli_query(
        $conn,
        "INSERT INTO report_qr
        (report_id,qr_file)
        VALUES
        ('$report_id','$file_name')"
        );

        $message = $file_name;
    }
    else
    {
        $error = "Report Not Found";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>QR Verification</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container py-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>🔐 Generate Report QR</h3>

</div>

<div class="card-body">

<form method="POST">

<label>Report ID</label>

<input
type="number"
name="report_id"
class="form-control"
required>

<br>

<button
name="generate"
class="btn btn-primary">

Generate QR

</button>

</form>

<?php
if(isset($error))
{
echo "<div class='alert alert-danger mt-3'>$error</div>";
}
?>

<?php
if($message!="")
{
?>

<hr>

<h4>Generated QR</h4>

<img
src="../assets/qr/<?php echo $message; ?>"
width="250">

<br><br>

<a
href="../assets/qr/<?php echo $message; ?>"
download
class="btn btn-success">

Download QR

</a>

<?php
}
?>

</div>

</div>

</div>

</body>

</html>