<?php
  session_start();
  // include db config
  include("../../config/user_config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MY PURCHASE</title>
  
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

  <!-- js file -->
  <script src="../../js/user_Script.js"></script>

  <!-- MY PURCHASE SECTION STARTS HERE -->
  <section class="product">
    <?php
      include("../../auth/modalForm.php");

      // check whether user is logged in or not after js file & modalForm.php loads
      if (!isset($_SESSION["UID"])) {
          // show login popup for logged out user
          echo '<script>
                  document.addEventListener("DOMContentLoaded", function() {               
                      openLoginPopup();
                  });
                </script>';
          
          // page title for logged out user
          echo '<h2 id="section-title">-- LOG IN TO VIEW PURCHASE HISTORY --</h2>';
          exit;
      } else {
          $userID = $_SESSION["UID"];
          // page title for logged in user
          echo '<h2 id="section-title">MY PURCHASE HISTORY</h2>';
      }
      ?>

      <div class="purchase-history">

        <!-- sql for retrieving purchase history info -->
        <?php
          $sql = "SELECT * FROM purchase WHERE userID = '$userID' ORDER BY purchaseID DESC";
          $result1 = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result1) > 0) {
            while ($row1 = mysqli_fetch_assoc($result1)) {
        ?>

        <table>
          <br><br>

          <!-- header for purchase history info -->
          <tr>
            <th>PURCHASE ID</th>
            <th>PURCHASE DATE</th>
            <th>PURCHASE AMT (RM)</th>
          </tr>
          
          <!-- content for purchase history info -->
          <tr>
            <td><?php echo $row1["purchaseID"]; ?> </td>
            <td><?php echo $row1["purchaseDate"]; ?> </td>
            <td><?php echo number_format($row1["purchaseAmt"], 2); ?> </td>
          </tr>
        </table>


        <!-- sql for retrieving purchase history detail -->
        <?php
          $sql2 = "SELECT p.productID, p.productName, p.productPrice, p.categoryID, pd.purchaseQty
          FROM purchase_detail pd, product p
          WHERE pd.productID = p.productID AND pd.purchaseID = '" . $row1["purchaseID"] . "'";

          $result2 = mysqli_query($conn, $sql2);
          if (mysqli_num_rows($result2) > 0) {
            $itemNum = 0;
        ?>

            <table>
              <!-- header for purchase history detail -->
              <tr>
                <th>&nbsp;&nbsp;#&nbsp; &nbsp;</th>
                <th>PRODUCT NAME</th>
                <th>UNIT PRICE (RM)</th>
                <th>PURCHASE QTY</th>
                <th>REVIEW</th>
              </tr>

              <?php
                while ($row2 = mysqli_fetch_assoc($result2)) {
                  $itemNum++;
                  // check both productID and purchaseID
                  $query = "SELECT reviewID 
                  FROM review 
                  WHERE productID = '" . $row2["productID"] . "' 
                  AND purchaseID = '" . $row1["purchaseID"] . "'";
              
                  $review = mysqli_query($conn, $query);
                  if (mysqli_num_rows($review) > 0) {
                      $reviewFlag = "Y";
                  } else {
                      $reviewFlag = "N";
                  }
              ?>
              
                <!-- content for purchase history detail -->
                <tr>
                  <td><?php echo $itemNum ?></td>
                  <td><?php echo $row2["productName"]; ?></td>
                  <td><?php echo $row2["productPrice"]; ?></td>
                  <td><?php echo $row2["purchaseQty"]; ?></td>
                  <td>
                    <?php
                      if ($reviewFlag == "Y") {
                        echo '<i class="fa fa-check"></i> Done';
                      } 
                      else {
                        $productID = $row2["productID"];
                        $purchaseID = $row1["purchaseID"];
                        $productName = urlencode($row2["productName"]);
                        $reviewLink = BASE_URL . "/user/pages/review/reviewForm.php?productID=$productID&purchaseID=$purchaseID&productName=" . urlencode($productName);

                        echo "<a href=\"$reviewLink\">
                                <i class=\"fa fa-comment\"></i> Review
                              </a>";
                      }
                    ?>
                  </td>
                </tr>
                <?php
                }
                echo "</body></table><br><br>";
                mysqli_free_result($result2);
              }
          }
            mysqli_free_result($result1);
        }
        else {
          ?>
          <p id="section-title">-- NO PURCHASE HISTORY --</p>
        <?php
        }
        mysqli_close($conn);
        ?>
      </div>

    </section>
  <!-- MY ORDER SECTION ENDS HERE -->

  <!-- USER FOOTER SECTION STARTS HERE -->
  <?php include '../../includes/user_Footer.php'; ?>
  <!-- USER FOOTER SECTION ENDS HERE -->    

</body>