<!-- include db config (admin_config.php) -->
<?php include("../../config/admin_config.php"); ?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN PRODUCT FORM</title>
  
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

      <!-- PRODUCT FORM SECTION STARTS HERE -->
      
      <!-- form title -->
      <h2 id="admin-formTitle">PRODUCT FORM</h2>

      <!-- form details -->
      <div class="admin-productForm">
        <form action="admin_InsertProduct.php" method="POST" enctype="multipart/form-data">
          <!-- product details -->
          <label for="productName">Product Name:</label><br>
          <input type="text" id="productName" name="productName" required><br><br>

          <label for="productQty">Product Quantity:</label><br>
          <input type="number" id="productQty" name="productQty" required><br><br>

          <label for="productPrice">Product Price:</label><br>
          <input type="number" id="productPrice" name="productPrice" min="0.01" step="0.01" required><br><br>

          <label for="categoryID">Product Category:</label><br> 
          <select id="categoryID" name="categoryID" required>
            <option value="">-- select category --</option>
            <?php
              // fetch categories from the database
              $categoryQuery = "SELECT * FROM category";
              $categoryResult = mysqli_query($conn, $categoryQuery);

                // display categories dynamically in dropdown list
                if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
                  while ($category = mysqli_fetch_assoc($categoryResult)) {
                    echo '<option value="' . htmlspecialchars($category['categoryID']) . '">' 
                        . htmlspecialchars($category['categoryName']) . '</option>';
                  }
                } else {
                  echo '<option value="">No categories available</option>';
                }
            ?>
          </select><br><br>


          <!-- product image -->
          <label for="productImg">Product Image:</label><br>
          <input type="file" id="productImg" name="productImg" accept="image/*" required><br><br>

          <!-- form button -->
          <button type="submit">Submit</button>
        </form>
      </div>     
      <!-- PRODUCT FORM SECTION ENDS HERE -->
      
    </div>
  </section>
  <!-- ADMIN DASHBOARD SECTION ENDS HERE -->
   

  <!-- js file -->
  <script src="../../js/admin_Script.js"></script>

</body>
</html>