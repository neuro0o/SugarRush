<?php
  // include db config
  include("../../config/admin_config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN DELETE CATEGORY</title>
  
  <!-- css file -->
  <link rel="stylesheet" href="../../css/admin_Style.css">
</head>

<body>
  <?php
    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
      $categoryID = intval($_GET['id']);
      // delete category record
      $sql = "DELETE FROM category WHERE categoryID = ?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "i", $categoryID);

      if (mysqli_stmt_execute($stmt)) {
        echo "
              <div id='categorySuccessMessage'>
                <p>CATEGORY WITH ID ($categoryID) DELETED SUCCESSFULLY!</p>
                <a id='adminDashboardLink' href='" . ADMIN_BASE_URL . "'>
                  Back to Admin Dashboard
                </a>
                <br>
                <a id='viewCategoryList' href='admin_CategoryList.php'>
                  View Category List
                </a>
                <br>
                <a id='createCategoryLink' href='admin_CategoryForm.php'>
                  Create New Category
                </a>
              </div>
              ";
      }
      else {
        echo "Error deleting record: " . mysqli_error($conn);
      }
      mysqli_stmt_close($stmt);
    }
    else {
      echo "Invalid request.";
    }
    mysqli_close($conn);
  ?>
</body>