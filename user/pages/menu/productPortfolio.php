<?php
  session_start();
  // include db config
  include("../../config/user_config.php");

  // check if specific product ID is provided
  if (isset($_GET['id'])) {
    $productID = intval($_GET['id']);
    // fetch the specific product based on the product ID
    $sql_product = "SELECT * FROM product WHERE productID = $productID";
  }
  // check if category is selected
  else if(isset($_GET['cat']) && ($_GET['cat']!= '0')){
    $categoryID = $_GET['cat'];
    // fetch product based on the selected category
    $sql_product = "SELECT * FROM product WHERE categoryID = $categoryID";
  }
  else {
    // fetch all product if no category is selected or All categories is selected
    $sql_product = "SELECT * FROM product";
  }
  
  $result = mysqli_query($conn, $sql_product);
  $rowcount = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRODUCT PORTFOLIO</title>
  
  <!-- cdn icon link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- css file -->
  <link rel="stylesheet" href="../../css/user_Style.css">
</head>

<body>
  <!-- USER HEADER SECTION STARTS HERE -->
  <?php include '../../includes/user_Header.php'; ?>
  <!-- USER HEADER SECTION ENDS HERE -->

  <!-- USER TOP NAV SECTION STARTS HERE -->
  <?php include '../../includes/user_topNav.php'; ?>
  <!-- USER TOP NAV SECTION ENDS HERE -->

  <!-- LOGIN POPUP SECTION STARTS HERE -->
  <?php include '../../auth/login_popup.php'; ?>
  <!-- LOGIN POPUP SECTION ENDS HERE -->

  <!-- REGISTER POPUP SECTION STARTS HERE -->
  <?php include '../../auth/register_popup.php'; ?>
  <!-- REGISTER POPUP SECTION ENDS HERE -->
   

  <!-- product section starts here -->
   <section class="product">
    <!-- page title -->
    <h2 id="section-title">PRODUCT PORTFOLIO</h2>
    <div class="category-container">
      
      <!-- category lists -->
      <a id="category-link" href="productPortfolio.php?cat=0" class="category-link">All</a> <!-- link for all products -->
      <?php
        // fetch categories from the database
        $categoryQuery = "SELECT * FROM category";
        $categoryResult = mysqli_query($conn, $categoryQuery);

        // display categories dynamically
        if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
          while ($category = mysqli_fetch_assoc($categoryResult)) {
            echo '<a id="category-link" href="productPortfolio.php?cat=' . $category['categoryID'] . '" class="category-link">' . $category['categoryName'] . '</a>';
          }
        } 
        else {
          echo '<p id="no-category-link">No categories found.</p>';
        }
      ?>
    </div>

    <!-- product Section -->
    <div class="product-container">
      <?php
        // check if products exist for the selected category
        if ($rowcount > 0) {
          while ($product = mysqli_fetch_assoc($result)) {
            echo '<div id="product-card" class="product-card">';
            echo '<img id="product-card-img" src="' . BASE_URL . '/' . $product["productImg"] . '" alt="' . $product["productName"] . '">';
            echo '<h3 id="product-card-name">' . $product["productName"] . '</h3>';
            echo '<p id="product-card-price">(RM ' . $product["productPrice"]. ')</p><br><br><br>';
            // echo '<p>Image Address: ' . $product["productImg"] . '</p>';

            // check if the user is logged in or not
            if (isset($_SESSION['UID'])) {
              // add product to cart
              echo '<form id="cart-amount-input" method="post" action="cart_action.php?action=add&id=' . $product['productID'] . '">
                      <input type="number" name="quantity" placeholder="Enter Qty (1-999)" min="1" max="999"><br><br>
                      <button type="submit">
                      <i class="fa fa-shopping-cart" ></i>
                      </button>
                    </form>';
            }
            else {
              echo '<h2><i>Login to purchase product.</i></h2>';
            }

            echo '</div>';
          }
        } else {
          echo '<p id="product-not-found">No products found for this category.</p>';
        }

        // free result set
        mysqli_free_result($result);
      ?>
    </div>    
   </section>
  <!-- product section ends here -->
  
  <!-- USER FOOTER SECTION STARTS HERE -->
  <?php include '../../includes/user_Footer.php'; ?>
  <!-- USER FOOTER SECTION ENDS HERE -->

  <!-- js file -->
  <script src="../../js/user_Script.js"></script>

</body>

