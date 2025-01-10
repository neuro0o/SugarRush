<?php
  session_start();
  // include db config
  include("../../config/user_config.php");

  // fetch blog entries from blog table in database
  $sql_blog = "SELECT b.blogID, b.blogTitle, b.blogEntry, b.blogImg, b.blogDate, u.userName 
  FROM blog b 
  JOIN user u ON b.createdBy = u.userID 
  ORDER BY b.blogDate DESC";
  $result_blog = mysqli_query($conn, $sql_blog);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BLOG</title>
  
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

  <!-- BLOG SECTION STARTS HERE -->
  <section class="blog">
    <!-- page title -->
    <h2 id="section-title">BLOG UPDATE</h2>

    <div class="blog-container">
      <?php
        // check if there are blog entries
        if (mysqli_num_rows($result_blog) > 0) {
          while ($row_blog = mysqli_fetch_assoc($result_blog)) {
            echo '<div class="blog-card">';
            echo '<p class="blog-card-date">Published on: ' . $row_blog["blogDate"] . '</p>';
            echo '<img class="blog-card-img" src="' . BASE_URL . '/' . $row_blog["blogImg"] . '" alt="' . $row_blog["blogTitle"] . '">';
            echo '<h3 class="blog-card-title">' . $row_blog["blogTitle"] . '</h3><br>';
            echo '<p class="blog-card-author">Published by: ' . $row_blog["userName"] . '</p><br><br>';
            echo '<p class="blog-card-entry">' . $row_blog["blogEntry"] . '</p><br><br>';
            echo '</div>';
          }
        } else {
          echo '<p>No blog entries found.</p>';
        }
  
        // free result set
        mysqli_free_result($result_blog);
      ?>
    </div>


  </section>
  <!-- BLOG SECTION ENDS HERE -->

  <!-- USER FOOTER SECTION STARTS HERE -->
  <?php include '../../includes/user_Footer.php'; ?>
  <!-- USER FOOTER SECTION ENDS HERE -->

  <!-- js file -->
  <script src="../../js/user_Script.js"></script>
  
</body>