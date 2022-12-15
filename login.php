<?php

$notValid = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $mysqli = require __DIR__ . '/db.php';
    $sql = sprintf("SELECT * FROM user WHERE email='%s'", $mysqli->real_escape_string($_POST['email']));
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    // var_dump($user);

    if($user) {
        if (password_verify($_POST['password'], $user['password_hash'])){
          session_start();
          session_regenerate_id();
          $_SESSION['user_id'] = $user['id'];
          header('location: signup-success.php');
        }
      }
      $notValid = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="icon" type="image/png" sizes="16x16" href="websiteplanet.com-favicons/favicons//favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
</head>

<body>

    <?php if ($notValid) : ?>
        <em>Invalid Details</em>
    <?php endif; ?>

    <form action="login.php" method="post">
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <button type="submit">Login</button>
    </form>
</body>

</html>