<?php 
  // include db config
  include("../../config/admin_config.php");
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN REVIEW LIST</title>
  
  <!-- cdn icon link -->
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

      <!-- REVIEW LIST SECTION STARTS HERE -->
      <!--form list title  -->
      <h2 id="admin-formTitle">Review List</h2>

      <!-- review filter form -->
      <div class="review-search">
        <form method="GET" action="">
          <select name="product_name" id="product_name" required>
            <option value="">-- Select a Product --</option>
            <!-- option to display all -->
            <option value="">ALL PRODUCT</option>
            <?php
              $sql_products = "SELECT productID, productName FROM product";
              $product_result = mysqli_query($conn, $sql_products);
              
              while ($product_row = mysqli_fetch_assoc($product_result)) {
                $selected = isset($_GET['product_name']) && $_GET['product_name'] == $product_row['productID'] ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($product_row['productID']) . "' $selected>" . htmlspecialchars($product_row['productName']) . "</option>";
              }
            ?>
          </select>
          <button type="submit" aria-label="Search"><i class="fa fa-search"></i></button>
        </form><br><br><br>
      </div>

      <!-- review list table -->
      <div class="admin-reviewListContainer">
        <?php
          $sql_review = "SELECT r.reviewID, r.purchaseID, r.reviewText, r.rating, r.reviewDate, u.userName, p.productName 
          FROM review r 
          JOIN user u ON r.reviewBy = u.userID 
          JOIN product p ON r.productID = p.productID ";

          if (!empty($_GET['product_name'])) {
            $product_name = mysqli_real_escape_string($conn, $_GET['product_name']);
            $sql_review = $sql_review . "WHERE r.productID = '$product_name' ";
          }

          $sql_review = $sql_review . "ORDER BY r.reviewDate DESC";
          $result = mysqli_query($conn, $sql_review);
          $rowcount = mysqli_num_rows($result);
        ?>
        <table id="review-table">
          <tr>
            <th>Review Date</th>
            <th>Review ID</th>
            <th>Purchase ID</th>
            <th>Product Name</th>
            <th>Reviewed By</th>
            <th>Review Text</th>
            <th>Rating</th>
          </tr>
          <?php
            if ($rowcount > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["reviewDate"]) . "</td>
                        <td>" . htmlspecialchars($row["reviewID"]) . "</td>
                        <td>" . htmlspecialchars($row["purchaseID"]) . "</td>
                        <td>" . htmlspecialchars($row["productName"]) . "</td>
                        <td>" . htmlspecialchars($row["userName"]) . "</td>
                        <td>" . htmlspecialchars($row["reviewText"]) . "</td>
                        <td>" . htmlspecialchars($row["rating"]) . "</td>
                      </tr>";
              }
            } else {
              echo "<tr><td colspan='7'>No reviews found.</td></tr>";
            }

            mysqli_free_result($result);
            mysqli_close($conn);
          ?>
        </table>
        <h2 id="list-row-count">Total Reviews: <?php echo $rowcount; ?></h2>
      </div>           
    </div>
  </section>

  <!-- js file -->
  <script src="../../js/admin_Script.js"></script>
  
</body>
</html>
