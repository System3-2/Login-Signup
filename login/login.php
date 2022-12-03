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
  <h2>Sign-Up</h2>
  <form action="login_val.php" method="post">
    <div>
      <label for="name">Name</label>
      <input type="text" name="name" id="name" required>
      </label>
    </div>
    <div>
      <label for="email">Email</label>
      <input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
    </div>
    <div>
      <label for="password">Password</label>
      <input type="password" name="password" id="password" required>
    </div>
    <div>
      <label for="password_confirmation">Confirm Password</label>
      <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>
    <button type="submit">Submit</button>
  </form>
  <a href="enter.php">Login</a>
</body>

</html>