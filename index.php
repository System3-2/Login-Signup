<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['password_confirmation'];

    if (empty($name)) {
        die("Name is required");
    }
    if (empty($email)) {
        die("Email is required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email is invalid");
    }
    if (empty($password)) {
        die("Password is required");
    }
    if (strlen($password) < 8) {
        die("Password is too short");
    }
    if (!preg_match('/[a-z]/i', $password)) {
        die("Password must contain at least a characters");
    }
    if (!preg_match('/[0-9]/', $password)) {
        die("Password must contain at least a number");
    }
    if (empty($passwordConfirm)) {
        die("Password Confirm is required");
    }
    if ($password !== $passwordConfirm) {
        die("Passwords do not match");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    // var_dump($password_hash);

    $mysqli = require __DIR__ . '/db.php';
    $sql = "INSERT INTO user (name, email, password_hash)
        VALUES (?, ?, ?)";
    $stmt = $mysqli->stmt_init();

    if (!$stmt->prepare($sql)) {
        die("SQL error" .$mysqli->error);
    }

    $stmt->bind_param("sss", $name, $email, $password_hash);

    if ($stmt->execute()) {
        header('location: login.php');
        exit();
    }
    else{
        if($mysqli->error== 1062){
            die("Account exists");
        }
        die("Signup bad");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="icon" type="image/png" sizes="16x16" href="websiteplanet.com-favicons/favicons//favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
</head>

<body>
    <form action="index.php" method="post" novalidate>
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Name">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
        </div>
        <button type="submit">Submit</button>
    </form>
    <a href="login.php">Login</a>
</body>

</html>