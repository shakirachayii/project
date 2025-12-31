<?php
session_start();
include '../db.php';

// Add Case
if(isset($_POST['add_case'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp_name,"../admin_area/uploads/".$image);

    $conn->query("INSERT INTO mobile_cases (name, price, image) VALUES ('$name','$price','$image')");
    header("Location: dashboard.php");
}

// Delete Case
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM mobile_cases WHERE id=$id");
    header("Location: dashboard.php");
}

// Fetch all cases
$result = $conn->query("SELECT * FROM mobile_cases");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="admin.css">
</head>
<body>
<div class="dashboard-container">

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-header"><h2>PhoneCase Hub</h2></div>
    <ul class="sidebar-menu">
      <li><a href="#" class="active">Dashboard</a></li>
        </ul>
  </aside>

  <!-- Main Content -->
  <main class="main-content">
    <header>
      <h1>Manage Phone Cases</h1>
    </header>

    <!-- Add Case Form -->
    <section class="form-section">
      <h2>Add New Case</h2>
      <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Case Name" required>
        <input type="number" name="price" placeholder="Price" step="0.01" required>
        <input type="file" name="image" required>
                <button type="submit" name="add_case">Add Case</button>
      </form>
    </section>

    <!-- Products Table -->
    <section class="table-section">
      <h2>Existing Cases</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()){ ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td>$<?= $row['price'] ?></td>
            <td><img src="../admin_area/uploads/<?= $row['image'] ?>" width="50"></td>
            <td>
              <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
              <a href="dashboard.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this case?')">Delete</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </section>
  </main>

</div>
</body>
</html>
