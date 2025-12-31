<?php
session_start();
include '../db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM mobile_cases WHERE id=$id");
$case = $result->fetch_assoc();

if(isset($_POST['update_case'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    if($image != ""){
        $tmp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp_name,"../admin_area/uploads/".$image);
        $conn->query("UPDATE mobile_cases SET name='$name', price='$price', image='$image' WHERE id=$id");
    }else{
        $conn->query("UPDATE mobile_cases SET name='$name', price='$price' WHERE id=$id");
    }
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Case</title>
<link rel="stylesheet" href="admin.css">
</head>
<body>
<div class="edit-form-container">
  <h2>Edit Case</h2>
  <form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" value="<?= $case['name'] ?>" required>
    <input type="number" name="price" value="<?= $case['price'] ?>" step="0.01" required>
    <label>Current Image</label>
    <div class="current-image">
        <img src="../admin_area/uploads/<?php echo $case['image']; ?>" alt="Current Image">
    </div>
    <input type="file" name="image">
    <button type="submit" name="update_case">Update Case</button>
  </form>
</div>
</body>
</html>
