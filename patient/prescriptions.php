
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
"SELECT p.*, d.doctor_name
FROM prescriptions p
LEFT JOIN doctors d
ON p.doctor_id = d.doctor_id
WHERE p.user_id = '$user_id'
ORDER BY p.created_at DESC"
);

?>

<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>My Prescriptions</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f4f7fb;
}

.header-box{
    background:linear-gradient(135deg,#2563eb,#06b6d4);
    color:white;
    padding:25px;
    border-radius:20px;
    margin-bottom:25px;
}

.prescription-card{
    border:none;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.prescription-card:hover{
    transform:translateY(-3px);
    transition:.3s;
}

.info-label{
    font-weight:bold;
    color:#2563eb;
}

</style>

</head>

<body>

<div class="container py-4">

<div class="header-box">

<h2>
💊 My Prescriptions
</h2>

<p class="mb-0">
View medicines prescribed by your doctor and download PDF copies.
</p>

</div>

<?php

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
?>

<div class="card prescription-card mb-4">

<div class="card-body">

<h5 class="mb-3">

👨‍⚕️ Doctor:
<?php echo !empty($row['doctor_name']) ? $row['doctor_name'] : 'Doctor'; ?>

</h5>

<hr>

<p>
<span class="info-label">Medicine:</span>

<?php
echo !empty($row['medicine_name'])
? $row['medicine_name']
: (!empty($row['medicine']) ? $row['medicine'] : '-');
?>
</p>

<p>
<span class="info-label">Dosage:</span>

<?php echo !empty($row['dosage']) ? $row['dosage'] : '-'; ?>
</p>

<p>
<span class="info-label">Condition:</span>

<?php echo !empty($row['patient_condition']) ? $row['patient_condition'] : '-'; ?>
</p>

<p>
<span class="info-label">Remarks:</span>

<?php echo !empty($row['remarks']) ? $row['remarks'] : '-'; ?>
</p>

<p>
<span class="info-label">Date:</span>

<?php echo !empty($row['created_at']) ? $row['created_at'] : '-'; ?>
</p>

<div class="mt-3">

<a
href="download_prescription.php?id=<?php echo $row['prescription_id']; ?>"
class="btn btn-success">

<i class="bi bi-download"></i>

 Download PDF

</a>

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

No prescriptions available yet.

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

