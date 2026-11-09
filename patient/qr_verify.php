<?php

session_start();

?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>QR Verification</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container py-5">

<div class="card shadow">

<div class="card-header bg-info text-white">

<h3>📱 QR Verification</h3>

</div>

<div class="card-body">

<form method="GET" action="../verify_report.php">

<label>Enter Report ID</label>

<input
type="number"
name="report_id"
class="form-control"
required>

<br>

<button
class="btn btn-info">

Verify Report

</button>

</form>

</div>

</div>

</div>

</body>

</html>