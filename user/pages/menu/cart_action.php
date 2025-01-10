<?php
  session_start();
  // include db config
  include("../../config/user_config.php");

  // cart actions to either (add/remove/empty) the cart list
  if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
      // add product
      case "add":
        if (!empty($_POST["quantity"])) {
          $productID = $_GET["id"];
          $quantityToAdd = $_POST["quantity"];

          // initialize itemArray
          $itemArray = array();
  
          $sql = "SELECT * FROM product WHERE productID = '$productID'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);

          // check available product stock in database
          if ($row) {
            $availableStock = $row["productQty"];

            // check if there is enough stock
            if ($availableStock >= $quantityToAdd) {
              $pid = "pid" . $row["productID"];

              // array for cart item
              $itemArray = array(
                  $pid => array('name' => $row["productName"], 'img' => $row["productImg"], 'prodID' => $row["productID"], 'quantity' => $quantityToAdd, 'price' => $row["productPrice"])
              );

              // update the cart
              if (!empty($_SESSION["cart_item"])) {
                // check if current cart contains the product or not
                if (in_array($pid, array_keys($_SESSION["cart_item"]))) {
                  foreach ($_SESSION["cart_item"] as $k => $v) {
                    // replace the old quantity with the new quantity
                    if ($pid == $k) {
                      $_SESSION["cart_item"][$k]["quantity"] = $quantityToAdd;
                    }
                  }
                }
                else {
                  // add new product to the current cart if it doesn't exist
                  $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                }
              }
              else {
                // add to cart if no product exists in current cart yet
                $_SESSION["cart_item"] = $itemArray;
              }
            } 
            else {
              // show alert if not enough stock
              echo "<script type='text/javascript'>
                alert('Not enough stock available. Only " . $availableStock . " items left.');
                alert('No changes to current cart.');
              </script>";
            }
          }
        }
      break;
      
      // remove product
      case "remove":
        if (!empty($_SESSION["cart_item"])) {
          foreach ($_SESSION["cart_item"] as $k => $v) {
            if ("pid" . $_GET["prodID"] == $k)
              unset($_SESSION["cart_item"][$k]);
            if (empty($_SESSION["cart_item"]))
              unset($_SESSION["cart_item"]);
          }
        }
        break;
      
        // delete all products from the cart
      case "empty":
        unset($_SESSION["cart_item"]);
        break;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CART ACTION</title>
  
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

  <!-- CART ACTION SECTION STARTS HERE -->
  <section class="product">
    <!-- page title -->
    <h2 id="section-title">MY CART</h2>

    <div class="cart-action">
      <?php
        if (isset($_SESSION["cart_item"])) {
          $total_quantity = 0;
          $total_price = 0;
      ?>
      
      <table>

        <!-- header for cart list -->
        <tr>
          <th>PRODUCT ID</th>
          <th>PRODUCT NAME</th>
          <th>QUANTITY</th>
          <th>UNIT PRICE (RM)</th>
          <th>PRICE (RM)</th>
          <th>ACTIONS</th>
        </tr>
        
        <!-- content for cart list -->
        <?php
          foreach ($_SESSION["cart_item"] as $item) {
            $item_price = $item["quantity"] * $item["price"];
            ?>
            <tr>
              <td> <?php echo htmlspecialchars($item["prodID"]); ?> </td>
              <td> <?php echo htmlspecialchars($item["name"]); ?> </td>
              <td> <?php echo htmlspecialchars($item["quantity"]); ?> </td>
              <td> <?php echo htmlspecialchars($item["price"]); ?> </td>
              <td> <?php echo number_format($item_price, 2); ?> </td>
              <td> <a href="cart_action.php?action=remove&prodID=<?php echo $item["prodID"]; ?>"> <i class="fa fa-times-circle"></i> Remove</a> </td>
            </tr>

            <?php
              $total_quantity += $item["quantity"];
              $total_price += ($item["price"] * $item["quantity"]);
          }
            ?>

        <!-- empty row (for separation) -->
        <tr>
          <th colspan="6"></th>
        </tr>

        <!-- total row header & content -->
        <tr id="total-cart">
          <td colspan="2" align="right">TOTAL ITEM:</td>
          <td><?php echo $total_quantity; ?></td>
          <td colspan="1" align="right">TOTAL AMOUNT:</td>
          <td colspan="2"><?php echo "RM " . number_format($total_price, 2); ?></td>
        </tr>

        <!-- empty row (for separation) -->
        <tr>
          <th style="background-color: #FEE3EC;" colspan="6"></th>
        </tr>

        <!-- checkout row -->
        <tr id="checkout-cart">
          <td colspan="5" align="right"></td>
          <td colspan="1">
            <form method="post" action="checkout.php?price=<?php echo $total_price; ?>">
              <input type="hidden" name="tot_price" value="<?php echo $total_price; ?>">
              <button id="checkout-button" type="submit">CHECKOUT</button>
            </form>
          </td>
        </tr>
        
        <!-- empty row (for separation) -->
        <tr>
          <th style="background-color: #FEE3EC;" colspan="6"></th>
        </tr>
      </table>

      <p id="cart-misc-button">
        <a href="cart_action.php?action=empty">
          <i class="fa fa-trash"></i>
          Empty Cart
        </a>
      </p>

      <p id="cart-misc-button">
        <a href="productPortfolio.php">
          <i class="fa fa-shopping-bag"></i>
          Continue Shopping
        </a>
      </p>

      <?php
      } else {
      ?>
        <p id="section-title">-- Your Cart is Empty --</p>
      <?php
      }
      ?>
    </div>
  </section>
  <!-- CART ACTION SECTION ENDS HERE -->

  <!-- USER FOOTER SECTION STARTS HERE -->
  <?php include '../../includes/user_Footer.php'; ?>
  <!-- USER FOOTER SECTION ENDS HERE -->
</body>