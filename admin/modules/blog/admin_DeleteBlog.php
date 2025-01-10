<?php
  // include db config
  include("../../config/admin_config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN DELETE BLOG</title>
  
  <!-- css file -->
  <link rel="stylesheet" href="../../css/admin_Style.css">
</head>

<body>
  <?php
  if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
      $blogID = intval($_GET['id']);
      // delete the blog record
      $sql = "DELETE FROM blog WHERE blogID = ?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "i", $blogID);

      if (mysqli_stmt_execute($stmt)) {

          echo "
                <div id='blogSuccessMessage'>
                  <p>BLOG WITH ID ($blogID) DELETED SUCCESSFULLY!</p>
                  <a id='adminDashboardLink' href='" . ADMIN_BASE_URL . "'>
                    Back to Admin Dashboard
                  </a>
                  <br>
                  <a id='viewBlogList' href='admin_BlogList.php'>
                    View Blog List
                  </a>
                  <br>
                  <a id='createBlogLink' href='admin_blogForm.php'>
                    Create New Blog
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