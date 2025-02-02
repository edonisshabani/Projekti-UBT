<?php
include('../config.php');
//include('authentication.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

<section class="dashboard">
   <h1 class="heading">Dashboard</h1>

   <div class="box-container">
      <div class="box">
         <h3>Welcome!</h3>
         <p><?= isset($_SESSION['auth_user']['user_id']) ? $_SESSION['auth_user']['user_id'] : 'Guest'; ?></p>
         <a href="edit_users.php?id=<?= isset($_SESSION['auth_user']['user_id']) ? $_SESSION['auth_user']['user_id'] : 0; ?>" class="btn">Update Profile</a>
      </div>

      <div class="box">
      <?php
      if (!isset($con)) {
          die("Database connection error.");
      }

      $category_query = "SELECT COUNT(DISTINCT category) AS total FROM products";
      $category_result = mysqli_query($con, $category_query);
      $category_total = mysqli_fetch_assoc($category_result)['total'] ?? 0;
      ?>
         <h3>Categories</h3>
         <p><?= $category_total ?></p>
         <a href="#" class="btn">See Categories</a>
      </div>


   </div>
</section>
</body>
</html>
