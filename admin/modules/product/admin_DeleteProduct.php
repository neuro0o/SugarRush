<?php
  // include db config
  include("../../config/admin_config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN DELETE PRODUCT</title>
  
  <!-- css file -->
  <link rel="stylesheet" href="../../css/admin_Style.css">
</head>
<body>
  <?php
  if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
      $productID = intval($_GET['id']);
      // delete the product record
      $sql = "DELETE FROM product WHERE productID = ?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "i", $productID);

      if (mysqli_stmt_execute($stmt)) {

          echo "
                <div id='productSuccessMessage'>
                  <p>PRODUCT WITH ID ($productID) DELETED SUCCESSFULLY!</p>
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
        echo "Error deleting record: " . mysqli_error($conn);
      }

      mysqli_stmt_close($stmt);
  } else {
      echo "Invalid request.";
  }

  mysqli_close($conn);
  ?>
</body>