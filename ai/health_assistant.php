<?php

session_start();

include("../config/database.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: ../patient/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$response = "";

if(isset($_POST['ask']))
{
    $question = strtolower(trim($_POST['question']));

    $found = false;

    $knowledge = mysqli_query(
    $conn,
    "SELECT *
    FROM ai_knowledge"
    );

    while($row = mysqli_fetch_assoc($knowledge))
    {
        $keyword = strtolower($row['keyword']);

        if(strpos($question,$keyword)!==false)
        {
            $response = $row['response'];

            $found = true;

            break;
        }
    }

    if(!$found)
    {
        $response =
        "Sorry, I do not have information about that topic. Please consult your healthcare provider.";
    }

    mysqli_query(
    $conn,
    "INSERT INTO ai_chat_history
    (
        user_id,
        question,
        answer
    )
    VALUES
    (
        '$user_id',
        '$question',
        '$response'
    )"
    );
}
?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>AI Health Assistant</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f7fb;
}

.chat-header{
background:linear-gradient(135deg,#7c3aed,#2563eb);
color:white;
padding:25px;
border-radius:20px;
margin-bottom:25px;
}

.chat-card{
border:none;
border-radius:20px;
box-shadow:0px 5px 20px rgba(0,0,0,.08);
}

.bot-reply{
background:#ecfdf5;
padding:15px;
border-left:5px solid green;
border-radius:10px;
margin-top:20px;
}

</style>

</head>

<body>

<div class="container py-4">

<div class="chat-header">

<h2>🤖 AI Health Assistant</h2>

<p class="mb-0">
Ask healthcare related questions.
</p>

</div>

<div class="card chat-card">

<div class="card-body">

<form method="POST">

<label class="mb-2">
Ask Question
</label>

<textarea
name="question"
class="form-control"
rows="4"
required></textarea>

<br>

<button
name="ask"
class="btn btn-primary">

Ask AI

</button>

<a
href="../patient/dashboard.php"
class="btn btn-secondary">

Back

</a>

</form>

<?php
if($response!="")
{
?>

<div class="bot-reply">

<h5>
AI Response
</h5>

<p>

<?php echo $response; ?>

</p>

</div>

<?php
}
?>

</div>

</div>

</div>

</body>

</html>