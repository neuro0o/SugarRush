<?php
  // include db config
  include("../../config/admin_config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN INSERT CATEGORY</title>
  
  <!-- css file -->
  <link rel="stylesheet" href="../../css/admin_Style.css">
</head>

<body>
  <?php
    // handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $categoryName = $_POST['categoryName'];
      $categoryDesc = $_POST['categoryDesc'];

      $sql = "INSERT INTO category (categoryName, categoryDesc)
      VALUES ('$categoryName', '$categoryDesc')";

      if (mysqli_query($conn, $sql)) {
        echo "
            <div id='categorySuccessMessage'>
              <p>NEW CATEGORY CREATED SUCCESSFULLY!</p>
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
        echo "<br>Error: " . $sql . "<br>" . mysqli_error($conn); 
      }
    }
    mysqli_close($conn);
  ?>
</body>