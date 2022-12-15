<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $mysqli = require __DIR__ . '/db.php';
    $sql = "SELECT * FROM user WHERE id = {$_SESSION['user_id']}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="icon" type="image/png" sizes="16x16" href="websiteplanet.com-favicons/favicons//favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>

<body>
    <?php if (isset($_SESSION['user_id'])) : ?>
        <h2>Welcome <?= htmlspecialchars($user['name']) ?>!</h2>
        <a href="logout.php">Logout</a>
    <?php else : ?>
        <button> <a href="index.php">Signup</a></button>
    <?php endif; ?>
</body>

</html>