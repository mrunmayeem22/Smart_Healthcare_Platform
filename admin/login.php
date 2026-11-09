<?php

session_start();

include("../config/database.php");

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM admins
         WHERE username='$username'
         AND password='$password'"
    );

    if(mysqli_num_rows($query)>0)
    {
        $_SESSION['admin']=$username;

        header("Location: dashboard.php");
        exit();
    }
    else
    {
        $error="Invalid Login Credentials";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/admin.css">

</head>

<body>

<div class="login-container">

<div class="login-card">

<h1>🏥 MediSphere AI</h1>

<h5>Administrator Portal</h5>

<?php
if(isset($error))
{
echo "<p style='color:red;'>$error</p>";
}
?>

<form method="POST">

<input
type="text"
name="username"
placeholder="Username"
class="form-control mb-3"
required>

<input
type="password"
name="password"
placeholder="Password"
class="form-control mb-3"
required>

<button
name="login"
class="btn btn-dark w-100">

Login

</button>

</form>

<br>

<div class="text-center">

<a href="../index.php">

Back To Home

</a>

</div>

</div>

</div>

</body>
</html>
```
