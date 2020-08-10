<?php

include_once('api/classes/user.php');
include_once('api/classes/database.php');

$username = $_POST["username"];
$password = $_POST["password"];

$db = new DataBase();

$user = new User($db, $username, $password);
$user->userData();

?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>

<form action="/login.php" method="post">

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" value="peterparker" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" value="pp" required>

    <button type="submit">Login</button>

  </div>
</form>

</body>
</html>