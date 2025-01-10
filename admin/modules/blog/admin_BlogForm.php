<?php
  session_start();
  // include db config 
  include("../../config/admin_config.php");

  if (isset($_SESSION["UID"])) {
    $adminName = $_SESSION["userName"];
  }
  else {
    $adminName = 'Unknown';
  }
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN BLOG FORM</title>
  
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

      <!-- BLOG FORM SECTION STARTS HERE -->
      <!-- form title -->
      <h2 id="admin-formTitle">BLOG FORM</h2>

      <!-- form details -->
      <div class="admin-blogForm">
        <form action="admin_InsertBlog.php" method="POST" enctype="multipart/form-data">
          <!-- blog details -->
          <label for="blogTitle">Blog Title:</label><br>
          <input type="text" id="blogTitle" name="blogTitle" required><br><br>

          <label for="blogEntry">Blog Entry:</label><br>
          <textarea id="blogEntry" name="blogEntry" rows="3" cols="50" required></textarea><br><br>
          
          <label for="createdBy">Created By:</label><br>
          <input type="hidden" id="createdBy" name="createdBy" value="<?php echo $_SESSION['UID']; ?>" readonly>
          <input type="text" value="<?php echo $adminName; ?>" readonly><br><br>

          <label for="blogDate">Date Created:</label><br>
          <input type="date" id="blogDate" name="blogDate" required><br><br>

          <label for="blogImg">Blog Image:</label><br>
          <input type="file" id="blogImg" name="blogImg" accept="image/*" required><br><br>

          <!-- form button -->
          <button type="submit">Submit</button>
        </form>
      </div>
      <!-- BLOG FORM SECTION ENDS HERE -->

    </div>
  </section>
  <!-- ADMIN DASHBOARD SECTION ENDS HERE -->

  <!-- js file -->
  <script src="../../js/admin_Script.js"></script>
</body>