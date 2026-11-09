<?php

include("../config/database.php");

$response = "";
$status = "";
$icon = "";

$score = 100;
$risk_level = "";
$risk_color = "";

if(isset($_POST['analyze']))
{
    $test_name = $_POST['test_name'];
    $test_value = $_POST['test_value'];

    if($test_name=="Blood Sugar")
    {
        if($test_value > 140)
        {
            $response =
            "Your blood sugar level is above normal range. You may be at risk of diabetes. Consult your doctor.";

            $status="warning";
            $icon="⚠️";

            $score -= 35;
        }
        else
        {
            $response =
            "Your blood sugar level is within normal range.";

            $status="success";
            $icon="✅";
        }
    }

    elseif($test_name=="Hemoglobin")
    {
        if($test_value < 12)
        {
            $response =
            "Hemoglobin is below normal range. This may indicate mild anemia.";

            $status="warning";
            $icon="⚠️";

            $score -= 25;
        }
        else
        {
            $response =
            "Hemoglobin level is normal.";

            $status="success";
            $icon="✅";
        }
    }

    elseif($test_name=="Cholesterol")
    {
        if($test_value > 200)
        {
            $response =
            "Cholesterol level is high. Regular exercise and healthy diet are recommended.";

            $status="warning";
            $icon="⚠️";

            $score -= 30;
        }
        else
        {
            $response =
            "Cholesterol level appears normal.";

            $status="success";
            $icon="✅";
        }
    }

    else
    {
        $response =
        "No AI analysis available for this test.";

        $status="secondary";
        $icon="ℹ️";

        $score -= 10;
    }

    if($score >= 80)
    {
        $risk_level = "Low Risk";
        $risk_color = "success";
    }
    elseif($score >= 50)
    {
        $risk_level = "Moderate Risk";
        $risk_color = "warning";
    }
    else
    {
        $risk_level = "High Risk";
        $risk_color = "danger";
    }
}



?>

<!DOCTYPE html>
<html>

<head>

<title>MediSphere AI Assistant</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f4f7fb;
}

.hero-box{
    background:linear-gradient(135deg,#7c3aed,#2563eb);
    color:white;
    padding:30px;
    border-radius:25px;
    margin-bottom:25px;
}

.ai-card{
    border:none;
    border-radius:25px;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
}

.ai-icon{
    width:100px;
    height:100px;
    background:#eef2ff;
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:45px;
    margin:auto;
}

.result-box{
    border-radius:15px;
    padding:20px;
}
.risk-card{
    border:none;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.score-value{
    font-size:60px;
    font-weight:bold;
    color:#2563eb;
}

.health-meter{
    height:20px;
    border-radius:20px;
}

</style>

</head>

<body>

<div class="container py-5">

<div class="hero-box">

<h2>
🤖 MediSphere AI Health Assistant
</h2>

<p class="mb-0">
Instant health insights based on laboratory values using AI-assisted analysis.
</p>

</div>

<div class="card ai-card">

<div class="card-body p-5">

<div class="text-center mb-4">

<div class="ai-icon">

<i class="bi bi-robot"></i>

</div>

<h3 class="mt-3">

AI Report Analysis

</h3>

<p class="text-muted">

Enter your laboratory values and receive instant health guidance.

</p>

</div>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Select Test

</label>

<select
name="test_name"
class="form-select"
required>

<option value="">Choose Test</option>

<option>Blood Sugar</option>

<option>Hemoglobin</option>

<option>Cholesterol</option>

</select>

</div>

<div class="mb-4">

<label class="form-label">

Test Value

</label>

<input
type="number"
step="0.1"
name="test_value"
class="form-control"
placeholder="Enter Test Value"
required>

</div>

<div class="text-center">

<button
type="submit"
name="analyze"
class="btn btn-primary btn-lg">

<i class="bi bi-cpu"></i>

 Analyze Report

</button>

<a
href="../patient/dashboard.php"
class="btn btn-secondary btn-lg">

Dashboard

</a>

</div>

</form>

<div class="card risk-card mt-4">

<div class="card-body text-center">

<h4>
🏥 Health Risk Score
</h4>

<div class="score-value">

<?php echo $score; ?>/100

</div>

<div class="progress health-meter my-3">

<div
class="progress-bar bg-<?php echo $risk_color; ?>"
style="width:<?php echo $score; ?>%">

</div>

</div>

<span class="badge bg-<?php echo $risk_color; ?> fs-6">

<?php echo $risk_level; ?>

</span>

<p class="mt-3 text-muted">

This score is generated based on laboratory values and predefined medical thresholds.

</p>

</div>

</div>

<?php
if($response!="")
{
?>

<hr class="my-4">

<div class="alert alert-<?php echo $status; ?> result-box">

<h4>

<?php echo $icon; ?>

 AI Analysis Result

</h4>

<p class="mb-0">

<?php echo $response; ?>

</p>

</div>

<div class="card mt-3 border-0 bg-light">

<div class="card-body">

<h5>

📋 Recommendation

</h5>

<p class="mb-0">

This AI analysis is intended for informational purposes only and should not replace professional medical advice. Please consult your healthcare provider for diagnosis and treatment.

</p>

</div>

</div>

<?php
}
?>

</div>

</div>

</div>

</body>

</html>