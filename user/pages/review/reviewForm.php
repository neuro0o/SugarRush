<?php
  session_start();
  // include db config
  include("../../config/user_config.php");

  // check if productID is set in the URL
  if (isset($_GET['productID'])) {
    $productID = intval($_GET['productID']);

    // retrieve product details from database
    $sql = "SELECT p.productName, c.categoryName, p.productImg
    FROM product p
    JOIN category c ON p.categoryID = c.categoryID
    WHERE productID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $productID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
      $productName = $row['productName'];
      $categoryName = $row['categoryName'];
      $productImg = $row['productImg'];
    }
    else {
      echo "Product not found.";
      exit;
    }
    mysqli_stmt_close($stmt);
  }
  else {
    echo "Invalid Request.";
    exit;
  }

  // check if purchaseID is set in the URL
  if (isset($_GET['purchaseID'])) {
    $purchaseID = intval($_GET['purchaseID']);
  } else {
    echo "Invalid Request. Purchase ID is missing.";
    exit;
  }


  if (isset($_SESSION["UID"])) {
    $userName = $_SESSION["userName"];
  }
  else {
    $userName = 'Unknown';
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>REVIEW FORM</title>
  
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


  <!-- REVIEW FORM SECTION STARTS HERE -->
  <section class="review">
    <h2 id="section-title">REVIEW FORM</h2> 

    <!-- form details -->
    <div class="review-form">
      <form action="reviewAction.php" method="POST" enctype="multipart/form-data">

        <label for="purchaseID">Purchase ID:</label><br>
        <input type="text" name="purchaseID" value="<?php echo $purchaseID; ?>" readonly><br><br>

        <label for="productID">Product ID:</label><br>
        <input type="text" name="productID" value="<?php echo $productID; ?>" readonly><br><br>

        <label for="productName">Product Name:</label><br>
        <input type="text" value="<?php echo $productName; ?>" readonly><br><br>

        <label for="categoryName">Product Category:</label><br>
        <input type="text" name="categoryName" value="<?php echo $categoryName; ?>" readonly><br><br>

        <label for="productImage">Product Image:</label><br>
        <img src="<?= BASE_URL . '/' . htmlspecialchars($productImg) ?>" style="width:150px;height:150px;text-align: center;"><br><br>

        <label for="reviewBy">Reviewing as:</label><br>
        <input type="hidden" id="reviewBy" name="reviewBy" value="<?php echo $_SESSION['UID']; ?>" readonly>
        <input type="text" value="<?php echo $userName; ?>" readonly><br><br>
        
        <label for="reviewDate">Date of Review:</label><br>
        <input type="date" name="reviewDate" id="reviewDate" name="reviewDate" required><br><br>

        <label for="reviewText">Product Review:</label><br>
        <textarea id="reviewText" name="reviewText" rows="3" cols="50" required></textarea><br><br>

       <label for="rating">Rating (1-5):</label>
       <input type="range" name="rating" id="rating" min="1" max="5" value="3" oninput="updateLabel(this.value)">
       <span id="ratingLabel">(3)</span>

        <!-- form button -->
        <button type="submit">Submit</button>
      </form>
    </div>

  </section>
  <!-- REVIEW FORM SECTION ENDS HERE -->

  <!-- USER FOOTER SECTION STARTS HERE -->
  <?php include '../../includes/user_Footer.php'; ?>
  <!-- USER FOOTER SECTION ENDS HERE -->
   
  <!-- js file -->
  <script src="../../js/user_Script.js"></script>
  
</body>
