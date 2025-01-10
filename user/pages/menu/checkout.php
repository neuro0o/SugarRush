<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CHECKOUT</title>
  
  <!-- cdn icon link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- css file -->
  <link rel="stylesheet" href="../../css/user_Style.css">
</head>

<?php
    session_start();
    include("../../config/user_config.php");

    // ensure the user is logged in
    if (!isset($_SESSION["UID"])) {
        // terminate if user isn't logged in
        die("Error: User not logged in.");
    }

    // ensure the cart is not empty
    if (empty($_SESSION["cart_item"])) {
        // terminate if cart is empty
        die("Error: No items in the cart.");
    }

    // initialize variables
    $purchaseDate = date('Y-m-d');  // current date for purchase
    $purchaseAmt = 0;

    // calculate the total purchase amount and validate cart items
    foreach ($_SESSION["cart_item"] as $item) {
        if (!isset($item["price"], $item["quantity"])) {
            die("Error: Missing product price or quantity.");
        }
        $purchaseAmt += $item["price"] * $item["quantity"];
    }

    /*
        I tried Dr's method, but it always generates errors which I don't know how to properly fix,
        so I'm combining multiple solutions from
        stackoverflow & AI generated (╥‸╥)
    */

    // begin transaction in database
    mysqli_begin_transaction($conn);

    try {
        // insert into the purchase table
        $stmt = $conn->prepare("INSERT INTO purchase (userID, purchaseDate, purchaseAmt) VALUES (?, ?, ?)");
        $stmt->bind_param("isd", $_SESSION["UID"], $purchaseDate, $purchaseAmt);
        $stmt->execute();
        $purchaseID = $stmt->insert_id;
        $stmt->close();

        // insert into the purchase_detail table
        $stmt = $conn->prepare("INSERT INTO purchase_detail (purchaseID, productID, purchaseQty) VALUES (?, ?, ?)");

        // array to hold line IDs
        $lineIDs = [];

        foreach ($_SESSION["cart_item"] as $item) {
            $productID = $item["prodID"];
            $quantity = $item["quantity"];
            $stmt->bind_param("isi", $purchaseID, $productID, $quantity);
            $stmt->execute();

            // get the last inserted line IDs
            $lineIDs[] = $stmt->insert_id;

            // update stock in the product table
            $sqlUpdateStock = "UPDATE product SET productQty = productQty - ? WHERE productID = ?";
            $stmtUpdateStock = $conn->prepare($sqlUpdateStock);
            $stmtUpdateStock->bind_param("ii", $quantity, $productID);
            $stmtUpdateStock->execute();
            $stmtUpdateStock->close();

        }
        $stmt->close();

        // commit the transaction
        mysqli_commit($conn);

        // clear the cart
        unset($_SESSION["cart_item"]);

        // Display success message along with the purchase ID and line IDs
        echo "
                <div id='checkout-section'>
                    <p id='checkout-success-message'>Purchase successful! Purchase ID is: {$purchaseID}</p>
                    <p id='checkout-success-message'>Line IDs: " . implode(", ", $lineIDs) . "</p>
                    <a id='shopping-redirect' href='myPurchase.php'>My Purchase History</a>
                    <a id='shopping-redirect' href='productPortfolio.php'>Continue Shopping</a>
                </div>
            ";


    } catch (Exception $e) {
        // roll back the transaction in case of an error
        mysqli_rollback($conn);
        die("Error processing purchase: " . $e->getMessage());
    }

    // close the connection
    mysqli_close($conn);
?>