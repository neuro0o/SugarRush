<?php
  // include db config (admin_config.php)
  include("../../config/admin_config.php");
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN EDIT CATEGORY</title>
  
  <!-- cdn icon link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- css file -->
  <link rel="stylesheet" href="../../css/admin_Style.css">
</head>

<?php
  // check if ID is provided
  if (isset($_GET['id'])) {
    $categoryID = intval($_GET['id']);

    // another example to retrieve the existing category data using prepared statement
    $sql = "SELECT * FROM category WHERE categoryID = ?";
    $stmt_select = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt_select, "i", $categoryID);
    mysqli_stmt_execute($stmt_select);
    $result = mysqli_stmt_get_result($stmt_select);

    if ($row = mysqli_fetch_assoc($result)) {
      $categoryName = $row['categoryName'];
      $categoryDesc = $row['categoryDesc'];
    }
    else {
      echo "Category not found.";
      exit;
    }
    mysqli_stmt_close($stmt_select);
  }
  else {
    echo "Invalid request.";
    exit;
  }

  // handle category update form submission
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $categoryName = $_POST['categoryName'];
    $categoryDesc = $_POST['categoryDesc'];

    // update category using stmt_update
    $sql_update = "UPDATE category SET categoryName = ?, categoryDesc = ?
    WHERE categoryID = ?";
    $stmt_update = mysqli_prepare($conn, $sql_update);
    mysqli_stmt_bind_param($stmt_update, "ssi", $categoryName, $categoryDesc, $categoryID);

    // execute query
    if (mysqli_stmt_execute($stmt_update)) {
      echo "
            <div id='categorySuccessMessage'>
              <p> ($categoryName) with Category ID of ($categoryID) was edited successfully!</p>
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
      echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt_update);
    mysqli_close($conn);
    exit;
  }
?>

<body>
  <!-- ADMIN SIDENAV SECTION STARTS HERE -->
  <?php include("../../includes/admin_SideNav.php"); ?>
  <!-- ADMIN SIDENAV SECTION ENDS HERE -->

  <!-- ADMIN DASHBOARD SECTION STARTS HERE -->  
  <section class="admin-dashboard">
    <div class="dashboard-container">

      <!-- CATEGORY EDIT SECTION STARTS HERE -->
      <!-- form edit title -->
      <h2 id="admin-formTitle">EDIT CATEGORY</h2>

      <!-- form edit details -->
      <div class="admin-categoryForm">
        <form action="" method="POST">
          
          <input type="hidden" name="categoryID" value="<?= isset($categoryID) ? htmlspecialchars($categoryID) : 'NONE'; ?>">

          <label for="categoryName">Category Name:</label>
          <input type="text" id="categoryName" name="categoryName" value="<?= htmlspecialchars($categoryName) ?>" required><br><br>
          
          <label for="categoryDesc">Category Description:</label>
          <input type="text" id="categoryDesc" name="categoryDesc" value="<?= htmlspecialchars($categoryDesc) ?>" required><br><br>

          <button type="submit">Update</button>
        </form>
      </div>
      <!-- CATEGORY EDIT SECTION ENDS HERE -->
    </div>
  </section>
  <!-- ADMIN DASHBOARD SECTION ENDS HERE -->

  <!-- js file -->
  <script src="../../js/admin_Script.js"></script>

</body>