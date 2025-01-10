<?php
  session_start();
  // include db config
  include("../SUGARRUSH/user/config/user_config.php");  
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SUGAR RUSH</title>
  
  <!-- cdn icon link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- css file -->
  <link rel="stylesheet" href="./user/css/user_Style.css">
</head>
<body>

  <!-- USER HEADER SECTION STARTS HERE -->
  <?php include './user/includes/user_header.php';?>
  <!-- USER HEADER SECTION ENDS HERE -->

  <!-- USER TOP NAV SECTION STARTS HERE -->
  <?php include './user/includes/user_topNav.php';?>
  <!-- USER TOP NAV SECTION ENDS HERE -->

  <!-- LOGIN POPUP SECTION STARTS HERE -->
  <?php include 'user/auth/login_popup.php'; ?> 
  <!-- LOGIN POPUP SECTION ENDS HERE -->

  <!-- REGISTER POPUP SECTION STARTS HERE -->
  <?php include 'user/auth/register_popup.php'; ?> 
  <!-- REGISTER POPUP SECTION ENDS HERE -->
  
  <?php
    // alert message if user has logged out successfully
    if (isset($_GET['logout']) && $_GET['logout'] == 'success') {
      echo '<script type="text/javascript">alert("Logout successful!");</script>';
    }
  ?>
  
  <!-- HOME SECTION STARTS HERE -->
  <section class="home">
    <div class="home-content">

      <h2>Your Daily Dose of Happiness</h2>
      <p>
        At Sugar Rush, we don't just serve desserts - we serve smiles, giggles,
        and little moments of pure joy! Let us be your sweet escape from the everyday
        hustle and your happy place for all things yummy and delightful. From the first
        bite to the last, we're here to sprinkle a little happiness into your day. After
        all, here at Sugar Rush, desserts aren't just a treat - they're a mood!
      </p>
      <div class="product-btn">
        <a href="<?php echo BASE_URL; ?>/user/pages/menu/productPortfolio.php"><button>See More</button></a>
      </div>
    </div>
  </section>
  <!-- HOME SECTION ENDS HERE -->
  

  <!-- USER FOOTER SECTION STARTS HERE -->
   <?php include './user/includes/user_Footer.php';?>
  <!-- USER FOOTER SECTION ENDS HERE -->

  <!-- js file -->
  <script src="./user/js/user_Script.js"></script>

</body>
</html>