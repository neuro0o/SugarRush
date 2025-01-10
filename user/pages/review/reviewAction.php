<?php
  session_start();
  // include db config
  include("../../config/user_config.php");

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
  <title>REVIEW ACTION</title>
  
  <!-- cdn icon link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- css file -->
  <link rel="stylesheet" href="../../css/user_Style.css">
</head>

<body>
  <?php
    // handle form submission
    if($_SERVER["REQUEST_METHOD"] === "POST") {
      $purchaseID = mysqli_real_escape_string($conn, $_POST['purchaseID']);
      $productID = mysqli_real_escape_string($conn, $_POST['productID']);
      $reviewBy = mysqli_real_escape_string($conn, $_POST['reviewBy']);
      $reviewDate = mysqli_real_escape_string($conn, $_POST['reviewDate']);
      $reviewText = mysqli_real_escape_string($conn, $_POST['reviewText']);
      $rating = mysqli_real_escape_string($conn, $_POST['rating']);

      $sql = "INSERT INTO review (purchaseID, productID, reviewBy, reviewDate, reviewText, rating)
      VALUES ('$purchaseID','$productID', '$reviewBy', '$reviewDate', '$reviewText', '$rating')";

      if (mysqli_query($conn, $sql)) {
        echo "
          <div id='reviewSuccessMessage'>
            <p>REVIEW SUBMITTED SUCCESSFULLY!</p>
            <a id='userHomePageLink' href='" . BASE_URL . "'>
              Back to Home Page
            </a>
            <br>
            <br>
            <a id='createReviewLink' href='" . BASE_URL . "/user/pages/menu/myPurchase.php'>
            Submit Another Review
             </a>
          </div>
          ";
      }
      else {
        echo "<br>Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
  ?>
</body>