<?php
$isValid = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $mysqli = require __DIR__ . "/db.php";

  $sql = sprintf(
    "SELECT * FROM user
  WHERE enail = '%s'",
    $mysqli->real_escape_string($_POST["email"])
  );
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();

  if($user) {
    if (password_verify($_POST['password'], $user['password_hash'])){
      // die('login success');
      session_start();
      session_regenerate_id();
      $_SESSION['user_id'] = $user['id'];
      header('location:index.php');
    }
  }
  $isValid = true;
}
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
  <?php if($isValid) :?>
  <em>Invalid login</em>
  <?php endif; ?>
  <h2>Login</h2>
  <form method="post">
    <div>
      <label for="email">
        <input type="email" name="email" id="email">
      </label>
    </div>
    <div>
      <label for="password">
        <input type="password" name="password" id="password">
      </label>
    </div>
    <button type="submit">Login</button>
  </form>
</body>

</html>