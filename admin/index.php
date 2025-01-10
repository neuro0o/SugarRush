<?php 
  session_start();
  // include admin_config.php
  include("config/admin_config.php"); 
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN DASHBOARD</title>
  
  <!-- cdn icon link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- css file -->
  <link rel="stylesheet" href="../admin/css/admin_Style.css">
</head>
<body>

  <!-- ADMIN SIDENAV SECTION STARTS HERE -->
  <?php include("includes/admin_SideNav.php"); ?>
  <!-- ADMIN SIDENAV SECTION ENDS HERE -->

  <!-- ADMIN DASHBOARD SECTION STARTS HERE -->
  <section class="admin-dashboard">
    <div class="dashboard-container">

      <!-- admin dashboard welcome message -->
      <h2 id="admin-welcomeMessage">
        <span>WELCOME TO ADMIN PANEL DASHBOARD, <b><?php echo htmlspecialchars($_SESSION["userName"]); ?></b></span>
      </h2>
      
    </div>
  </section>
  <!-- ADMIN DASHBOARD SECTION ENDS HERE -->
   

  <!-- js file -->
  <script src="./js/admin_Script.js"></script>
  
</body>
</html>