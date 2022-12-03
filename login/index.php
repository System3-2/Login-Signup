<?php
session_start();
if (isset($_SESSION['user_id'])) {
  $mysqli = require __DIR__ . './db.php';

  $sql = "SELECT * FROM user WHERE id = {$_SESSION['user_id']}";
  $result = $mysqli->query($sql);

  $user = $result->fetch_assoc();
}
// print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Php Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>

<body>
  <?php if (isset($_SESSION['user_id'])) : ?>
    <h2>Welcome <?= htmlspecialchars($user['name']) ?>!</h2>
    <h2>You are logged in</h2>
    <a href="logout.php">Logout</a>
  <?php else : ?>
    <p><a href="enter.php">Login</a> or <a href="login.php">Sign-up</a></p>
  <?php endif; ?>
</body>

</html>