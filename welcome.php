<?php

include 'db.php';


session_start();
if(!isset($_SESSION['name'])){
  header("location:login.php");
  exit();
}
if(isset($_GET['logout'])){
  session_unset();
  session_destroy();
  header("Location:login.php");
  exit();
}
// $name = $_SESSION['name'];
$name = $_SESSION['name'] ?? 'User';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PhoneCase Hub</title>
  <link rel="stylesheet" href="welcomecss.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <header class="navbar">
    <div class="logo">PhoneCase Hub</div>
    <nav>
      <a href="#home">Home</a>
      <a href="#products">Products</a>
      <a href="#about">About</a>
      <a href="#contact">Contact</a>
<a href="welcome.php?logout=true" class="btn-login">Log Out</a>
    </nav>
  </header>

  <!-- Hero Section -->
  <section class="hero" id="home">
  </section>
  <a href="#products" class="btn">Shop Now</a>

  

  <!-- Featured Products -->
  <section class="products" id="products" style="margin-top: 250px;">
  <h2>Featured Cases</h2>

  <div class="product-grid">
    <?php
    $query = "SELECT * FROM mobile_cases";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)){
    ?>
      <div class="product-card">
        <img src="admin_area/uploads/<?php echo $row['image']; ?>" alt="">
        <h3><?php echo $row['name']; ?></h3>
        <p>$<?php echo $row['price']; ?></p>
        <a href="#" class="btn-small">Buy Now</a>
      </div>
    <?php } ?>
  </div>
</section>


  <!-- About Section -->
  <section class="about" id="about">
    <h2>About Us</h2>
    <p>PhoneCase Hub offers stylish, durable phone cases that protect your device while making it look amazing.</p>
  </section>

  <!-- Contact Section -->
  <section class="contact" id="contact">
    <h2>Contact Us</h2>
    <p>Email: support@phonecasehub.com</p>
    <p>Phone: +1 234 567 890</p>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 PhoneCase Hub. All rights reserved.</p>
  </footer>

</body>
</html>
