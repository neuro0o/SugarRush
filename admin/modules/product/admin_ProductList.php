<!-- include db config (admin_config.php) -->
<?php include("../../config/admin_config.php"); ?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN PRODUCT LIST</title>
  
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

      <!-- PRODUCT LIST SECTION STARTS HERE -->
      <!-- form list title -->
      <h2 id="admin-formTitle">PRODUCT LIST</h2>

      <!-- form list details -->
      <div class="admin-productListContainer">
        <?php

          // sql query to select product details along with category information
          $sql_product = "SELECT p.productID, p.productName, p.productImg, p.categoryID,
          c.categoryID, c.categoryName, p.productQty, p.productPrice 
          FROM product p, category c 
          WHERE p.categoryID = c.categoryID
          ORDER BY p.productID ASC";

          // execute query on the database connection
          $result = mysqli_query($conn, $sql_product);

          // get the number of rows returned by the query
          $rowcount = mysqli_num_rows($result);
        ?>
          <!-- start of the table -->
          <table id="product-table">
            <tr>               
                <th>PRODUCT ID</th>
                <th>CATEGORY NAME</th>
                <th>PRODUCT NAME</th>
                <th>PRODUCT PRICE (RM)</th>
                <th>PRODUCT QTY</th>
                <th>ACTIONS</th>
            </tr>

            <!-- dynamically create html table row based on output data of each row from product table -->
            <?php
              if ($rowcount > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";                    
                  echo "<td>" . htmlspecialchars($row["productID"]) . "</td>";
                  echo "<td>" . htmlspecialchars($row["categoryName"]) . "</td>";
                  echo "<td>" . htmlspecialchars($row["productName"]) . "</td>";
                  echo "<td>" . htmlspecialchars($row["productPrice"]) . "</td>";
                  echo "<td>" . htmlspecialchars($row["productQty"]) . "</td>";
                  echo "<td>";
                    echo "<a href='admin_EditProduct.php?id=" . urlencode($row["productID"]) . "'>Edit</a> | ";
                    echo "<a href='admin_DeleteProduct.php?id=" . urlencode($row["productID"]) . "' onclick='return confirm(\"Are you sure you want to delete this product?\");'>Delete</a>";
                  echo "</td>";
                  echo "</tr>";
                }
              }
              else {
                echo "<p>No results found.</p>";
              }
  
              // free result set
              mysqli_free_result($result);
              // close connection
              mysqli_close($conn);
            ?>
          </table>
          <!-- Display row count -->
          <h2 id="list-row-count">Total Products: <?php echo $rowcount; ?></h2>
        </div> 
      </div>           
    </div>
    <!-- PRODUCT LIST SECTION ENDS HERE -->
  </section>
  <!-- ADMIN DASHBOARD SECTION ENDS HERE -->
   
  <!-- js file -->
  <script src="../../js/admin_Script.js"></script>
  
</body>