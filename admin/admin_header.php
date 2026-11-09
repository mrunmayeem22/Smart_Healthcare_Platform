<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}
?>

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
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.table th{
    background:#0f172a;
    color:white;
}

</style>