<!-- include db config (admin_config.php) -->
<?php include("../../config/admin_config.php"); ?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN CATEGORY FORM</title>
  
  <!-- cdn icon link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- css file -->
  <link rel="stylesheet" href="../../css/admin_Style.css">
</head>

<body>
  <!-- ADMIN SIDENAV SECTION STARTS HERE -->
  <?php include("../../includes/admin_SideNav.php"); ?>
  <!-- ADMIN SIDENAV SECTION ENDS HERE -->

  <!-- ADMIN DASHBOARD SECTION STARTS HERE -->
  <section class="admin-dashboard">
    <div class="dashboard-container">

      <!-- CATEGORY FORM SECTION STARTS HERE -->
      <!-- form title -->
      <h2 id="admin-formTitle">CATEGORY FORM</h2>

      <!-- form details -->
       <div class="admin-categoryForm">
        <form action="admin_InsertCategory.php" method="POST">

          <!-- category details -->
          <label for="categoryName">Category Name:</label><br>
          <input type="text" id="categoryName" name="categoryName" required><br><br>

          <label for="categoryDesc">Category Description:</label><br>
          <textarea cols="30" rows="10" id="categoryDesc" name="categoryDesc"></textarea><br><br>

          <!-- form button -->
          <button type="submit">Submit</button>
        </form>
       </div>

      <!-- CATEGORY FORM SECTION ENDS HERE -->
    </div>
  </section>
  <!-- ADMIN DASHBOARD SECTION ENDS HERE -->

  <!-- js file -->
  <script src="../../js/admin_Script.js"></script>
  
</body>