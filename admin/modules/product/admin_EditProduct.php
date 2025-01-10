<?php
  // include db config
  include("../../config/admin_config.php");
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN EDIT PRODUCT</title>
  
  <!-- cdn icon link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- css file -->
  <link rel="stylesheet" href="../../css/admin_Style.css">
</head>

<?php
  // check if ID is provided
  if (isset($_GET['id'])) {
      $productID = intval($_GET['id']);

      // another example to retrieve the existing product data using prepared statement
      $sql = "SELECT * FROM product WHERE productID = ?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "i", $productID);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result)) {
          $productName = $row['productName'];
          $productPrice = $row['productPrice'];
          $productQty = $row['productQty'];
          $productImg = $row['productImg'];
      } 
      else {
          echo "Product not found.";
          exit;
      }
      mysqli_stmt_close($stmt);
  }
  else {
    echo "Invalid request.";
    exit;
  }

  // handle product update form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['productName'];
    $productQty = $_POST['productQty'];
    $productPrice = $_POST['productPrice'];

    $uploadDir = '../../../uploads/';
    $productImg = null;
    $image = null;

    // check if a new image is uploaded
    if (isset($_FILES['productImg']) && $_FILES['productImg']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['productImg']['tmp_name'];
        $fileName = basename($_FILES['productImg']['name']);
        $targetPath = $uploadDir . $fileName;

        // move the uploaded file
        if (move_uploaded_file($tmpName, $targetPath)) {
            $image = $fileName;

            // optional: delete the old image if necessary
            $sql = "SELECT productImg FROM product WHERE productID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $productID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $product = mysqli_fetch_assoc($result);

            if ($product && $product['productImg'] && file_exists($uploadDir . $product['productImg'])) {
                unlink($uploadDir . $product['productImg']); // deletes the old image file
            }
            mysqli_stmt_close($stmt);
            echo $productImg;
        }
    }

    if ($image) {
        //directory saved to DB
        $productImg = "uploads/" . $image;
        // echo $productImg;
        $sql = "UPDATE product SET productName = ?, productPrice = ?, productQty = ?, productImg = ? WHERE productID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sdisi", $productName, $productPrice, $productQty, $productImg, $productID);
    } else {
        $sql = "UPDATE product SET productName = ?, productPrice = ?, productQty = ? WHERE productID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sdii", $productName, $productPrice, $productQty, $productID);
    }

    // execute query
    if (mysqli_stmt_execute($stmt)) {
      echo "
            <div id='productSuccessMessage'>
              <p> ($productName) with Product ID of ($productID) was edited successfully!</p>
              <a id='adminDashboardLink' href='" . ADMIN_BASE_URL . "'>
                Back to Admin Dashboard
              </a>
              <br>
              <a id='viewProductList' href='admin_ProductList.php'>
                View Product List
              </a>
              <br>
              <a id='createProductLink' href='admin_ProductForm.php'>
                Create New Product
              </a>
            </div>
          ";
    }
    else {
      echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    exit;
  }
?>

<body>
  <!-- ADMIN SIDENAV SECTION STARTS HERE -->
  <?php include("../../includes/admin_SideNav.php"); ?>
  <!-- ADMIN SIDENAV SECTION ENDS HERE -->

  <!-- ADMIN DASHBOARD SECTION STARTS HERE -->
  <section class="admin-dashboard">
    <div class="dashboard-container">
      
      <!-- PRODUCT EDIT SECTION STARTS HERE -->
      <!-- form edit title -->
      <h2 id="admin-formTitle">EDIT PRODUCT</h2>

      <!-- form edit details -->
      <div class="admin-productForm">
        <form action="" method="POST" enctype="multipart/form-data">
        
          <input type="hidden" name="productID" value="<?= isset($productID) ? htmlspecialchars($productID) : 'NONE'; ?>">
          
          <label for="productName">Product Name:</label>
          <input type="text" id="productName" name="productName" value="<?= htmlspecialchars($productName) ?>" required><br><br>
          
          <label for="productPrice">Product Price:</label>
          <input type="text" id="productPrice" name="productPrice" value="<?= htmlspecialchars($productPrice) ?>" required><br><br>
          
          <label for="productPrice">Product Quantity:</label>
          <input type="text" id="productQty" name="productQty" value="<?= htmlspecialchars($productQty) ?>" required><br><br>
          
          <label for="prod_image">Product Image:</label><br>
          <img src="<?= BASE_URL . '/' . htmlspecialchars($productImg) ?>" style="width:150px;height:150px;text-align: center;"><br><br>
          <input type="file" id="productImg" name="productImg" accept="image/*"><br><br>
          
          <button type="submit">Update</button>
        </form>
      </div>
      <!-- PRODUCT EDIT SECTION ENDS HERE -->
    </div>
  </section>
  <!-- ADMIN DASHBOARD SECTION STARTS HERE -->

  <!-- js file -->
  <script src="../../js/admin_Script.js"></script>
</body>