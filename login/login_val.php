<?php 
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation'];

  if(empty($name)){
    die('<h2 style="color: red;">Name Required</h2>');
  }
  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    die('<h2 style="color: red;">Enter a valid email</h2');
  }
  if(empty($password)){
    die('<h2 style="color: red;">Password Required</h2>');
  }
  if(strlen($password) < 8){
    die('<h2 style="color: red;">Must be at least 8 characters</h2>');
  }
  if(!preg_match("/[a-z]/i",$password)){
    die('<h2 style="color: red;">Must contain at least a character</h2>');
  }
  if(!preg_match("/[0-9]/i",$password)){
    die('<h2 style="color: red;">Must contain at least a number</h2>');
  }
  if(empty($password_confirmation)){
    die('<h2 style="color: red;">Confirm Password</h2>');
  }
  if($password !== $password_confirmation){
    die('<h2 style="color: red;">Password must match</h2>');
}
$password_hash = password_hash($password, PASSWORD_BCRYPT);

$mysqli = require __DIR__ . "/db.php";

$sql = "INSERT INTO user (name, enail, password_hash)
        VALUES (?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss",
                  $name,
                  $email,
                  $password_hash);
                  
if ($stmt->execute()) {

    header("Location: signup-success.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}



// $pdo = new pdo('mysql:host=localhost;port=3306;dbname=logindb', 'root','');
// $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

// $statement = $pdo->prepare("INSERT INTO user (name ,enail, password_hash) 
//     VALUES (:name, :enail, :password_hash)
// ");
// $statement->bindValue(':name', $name);
// $statement->bindValue(":enail", $email);
// $statement->bindValue(':password_hash', $password_hash);

// if ($statement->execute()){
//   echo "Sign up successful";
// }
// else {
//   if($pdo->errno === 1062){
//     echo "Email already exits";
//   }
//   echo "Account already exist";
// }
// header('location: login.php');

// var_dump($password_hash);