<?php
   include("db.php");
   session_start();

   if (isset($_POST['submit'])){
    $name = $_POST['name'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE name='$name' AND password ='$password'";
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) == 1){
      $_SESSION['name'] = $name;
      header("Location:welcome.php");
      exit();
    }else{
      $error ="Invalid username or password!";
    }
   }
?>

 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Account</title>
  <link rel="stylesheet" href="login-all.css" />
</head>
<body>

  <div class="container">
    
    <div class="blob blob-top"></div>

    <div class="form-box">
     <h1>SIGN IN</h1>
     
    <form method="POST">
      <?php if(isset($error))echo "<p style='color:red;'>$error</p>";?>
 
      <label> name</label>
      <input type="name" name ="name" >

      <label> Password</label>
      <input type="password" name="password" >
      <button type="submit" name="submit">SIGN IN</button>
      </form>

        <span>you don't have an account? <a href="register.php">Sign up</a></span>
    </div>
    <div class="blob blob-bottom"></div>
  </div>
        
</body>
</html>

