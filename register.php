<?php
include "db.php";

$error = "";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if($password !== $confirmpassword){
        $error = "Passwords do not match ";
    } else {
        $sql = "INSERT INTO users(name,password) VALUES('$name','$password')";

        if(mysqli_query($conn,$sql)){
            header("Location: login.php"); // redirect to login
            exit;
        } else {
            $error = "SQL ERROR: ".mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Account</title>
<link rel="stylesheet" href="register-all.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="container">

  <div class="blob blob-top"></div>
  <div class="blob blob-bottom"></div>

  <div class="form-box">
    <h1>Create new Account</h1>

    <form method="POST">

      <label>Name</label>
      <input type="text" name="name" required>

      <label>Email</label>
      <input type="email" name="email" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <label>Confirm Password</label>
      <input type="password" name="confirmpassword" required>

      <button type="submit" name="submit">SIGN UP</button>
       <p class="login-text">
      Already Registered? <a href="login.php">Login</a>
    </p>
    </form>
  </div>

</div>


</body>
</html>
