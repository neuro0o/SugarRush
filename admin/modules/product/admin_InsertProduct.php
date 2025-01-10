<?php
  // include db config
  include("../../config/admin_config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN INSERT PRODUCT</title>
  
  <!-- css file -->
  <link rel="stylesheet" href="../../css/admin_Style.css">
</head>
<body>
  <?php
  // handle form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['productName'];
    $productQty = $_POST['productQty'];
    $productPrice = $_POST['productPrice'];
    $categoryID = $_POST['categoryID'];

    // handle image upload
    $target_dir = "../../../uploads/";
    $target_path = "uploads/";
    $target_file = $target_dir . basename($_FILES["productImg"]["name"]);
    $target_fileDB = $target_path . basename($_FILES["productImg"]["name"]);
    $upload_ok = 1;
  
    // check if image file is an actual image
    $check = getimagesize($_FILES["productImg"]["tmp_name"]);
    if ($check !== false) {
      $upload_ok = 1;
    } 
    else {
      echo "File is not an image.";
      $upload_ok = 0;
    }

    // move uploaded file to target directory
    if ($upload_ok && move_uploaded_file($_FILES["productImg"]["tmp_name"], $target_file)) {
          
      $sql = "INSERT INTO product (productName, productQty, productPrice, categoryID, productImg)
      VALUES ('$productName', '$productQty', '$productPrice', '$categoryID', '$target_fileDB')";

      if (mysqli_query($conn, $sql)) {
        echo "
              <div id='productSuccessMessage'>
                <p>NEW PRODUCT CREATED SUCCESSFULLY!</p>
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
        echo "<br>Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    } 
    else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
  mysqli_close($conn);
  ?>
</body>


