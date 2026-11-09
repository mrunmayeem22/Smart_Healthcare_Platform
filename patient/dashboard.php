<?php

session_start();

include("../config/database.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$full_name = $_SESSION['full_name'];

$count_query = mysqli_query(
$conn,
"SELECT COUNT(*) total
FROM notifications
WHERE user_id='$user_id'
AND status='Unread'"
);

$count = mysqli_fetch_assoc($count_query);

?>

<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Patient Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background:#f4f7fb;
}

.topbar{
    background:#0f172a;
    color:white;
    padding:15px 30px;
}

.welcome-card{
    background:linear-gradient(135deg,#2563eb,#06b6d4);
    color:white;
    border-radius:20px;
    padding:30px;
}

.dashboard-card{
    border:none;
    border-radius:20px;
    transition:.3s;
    box-shadow:0 4px 15px rgba(0,0,0,.08);
    height:100%;
}

.dashboard-card:hover{
    transform:translateY(-8px);
}

.dashboard-card i{
    font-size:45px;
    color:#2563eb;
}

.bi-robot{
    color:#7c3aed !important;
}

.bi-chat-dots-fill{
    color:#ec4899 !important;
}

.bi-qr-code-scan{
    color:#16a34a !important;
}

.bi-capsule-pill{
    color:#f59e0b !important;
}

.bi-calendar-check{
    color:#10b981 !important;
}

.bi-file-earmark-medical{
    color:#3b82f6 !important;
}

.bi-clock-history{
    color:#6366f1 !important;
}

.bi-journal-medical{
    color:#ef4444 !important;
}

.dashboard-card .btn{
    margin-top:15px;
}

</style>

</head>

<body>

<!-- HEADER -->

<div class="topbar d-flex justify-content-between align-items-center">

<h4 class="mb-0">
🏥 MediSphere AI
</h4>

<div>

<a
href="notifications.php"
class="btn btn-warning me-2">

🔔 <?php echo $count['total']; ?>

</a>

<a
href="profile.php"
class="btn btn-info me-2">

👤 My Profile

</a>

<a
href="logout.php"
class="btn btn-danger">

Logout

</a>

</div>

</div>

<!-- CONTENT -->

<div class="container py-4">

<div class="welcome-card mb-4">

<h2>

Welcome,
<?php echo $full_name; ?>

</h2>

<p class="mb-0">

Book appointments, access reports, manage prescriptions, use AI-powered healthcare tools and verify reports securely from one centralized healthcare platform.

</p>

</div>

<div class="row g-4">

<!-- APPOINTMENTS -->

<div class="col-md-4">

<div class="card dashboard-card">

<div class="card-body text-center">

<i class="bi bi-calendar-check"></i>

<h4 class="mt-3">

Appointments

</h4>

<p>

Book appointments and manage schedules.

</p>

<a
href="book_appointment.php"
class="btn btn-primary">

Open

</a>

</div>

</div>

</div>

<!-- REPORTS -->

<div class="col-md-4">

<div class="card dashboard-card">

<div class="card-body text-center">

<i class="bi bi-file-earmark-medical"></i>

<h4 class="mt-3">

My Reports

</h4>

<p>

View reports, PDFs and QR verification.

</p>

<a
href="my_reports.php"
class="btn btn-primary">

Open

</a>

</div>

</div>

</div>

<!-- PRESCRIPTIONS -->

<div class="col-md-4">

<div class="card dashboard-card">

<div class="card-body text-center">

<i class="bi bi-capsule-pill"></i>

<h4 class="mt-3">

Prescriptions

</h4>

<p>

View medicines and treatment plans.

</p>

<a
href="prescriptions.php"
class="btn btn-primary">

Open

</a>

</div>

</div>

</div>

<!-- AI ANALYSIS -->

<div class="col-md-4">

<div class="card dashboard-card">

<div class="card-body text-center">

<i class="bi bi-robot"></i>

<h4 class="mt-3">

AI Health Analysis

</h4>

<p>

Analyze laboratory values using AI assistance.

</p>

<a
href="../ai/report_analysis.php"
class="btn btn-success">

Open

</a>

</div>

</div>

</div>

<!-- AI ASSISTANT -->

<div class="col-md-4">

<div class="card dashboard-card">

<div class="card-body text-center">

<i class="bi bi-chat-dots-fill"></i>

<h4 class="mt-3">

AI Assistant

</h4>

<p>

Ask healthcare-related questions.

</p>

<a
href="../ai/health_assistant.php"
class="btn btn-success">

Open

</a>

</div>

</div>

</div>

<!-- QR VERIFICATION -->

<div class="col-md-4">

<div class="card dashboard-card">

<div class="card-body text-center">

<i class="bi bi-qr-code-scan"></i>

<h4 class="mt-3">

QR Verification

</h4>

<p>

Verify reports using secure QR codes.

</p>

<a
href="qr_verify.php"
class="btn btn-success">

Open

</a>

</div>

</div>

</div>

<!-- APPOINTMENT HISTORY -->

<div class="col-md-6">

<div class="card dashboard-card">

<div class="card-body text-center">

<i class="bi bi-journal-medical"></i>

<h4 class="mt-3">

Appointment History

</h4>

<p>

View all booked and completed appointments.

</p>

<a
href="my_appointments.php"
class="btn btn-warning">

Open

</a>

</div>

</div>

</div>
<div class="col-md-6">

<div class="card dashboard-card">

<div class="card-body text-center">

<i class="bi bi-journal-text"></i>

<h4 class="mt-3">

Doctor Notes

</h4>

<p>

View doctor observations and recommendations.

</p>

<a
href="doctor_notes.php"
class="btn btn-warning">

Open

</a>

</div>

</div>

</div>

<!-- HEALTH HISTORY -->

<div class="col-md-6">

<div class="card dashboard-card">

<div class="card-body text-center">

<i class="bi bi-clock-history"></i>

<h4 class="mt-3">

Health History

</h4>

<p>

Track your complete healthcare timeline.

</p>

<a
href="health_history.php"
class="btn btn-warning">

Open

</a>

</div>

</div>

</div>

</div>

</div>

</body>

</html>