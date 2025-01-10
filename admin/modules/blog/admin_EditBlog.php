<?php
  session_start();
  // include db config
  include("../../config/admin_config.php");

  if (isset($_SESSION["UID"])) {
    $adminName = $_SESSION["userName"];
  }
  else {
    $adminName = 'Unknown';
  }
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN EDIT BLOG</title>
  
  <!-- cdn icon link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- css file -->
  <link rel="stylesheet" href="../../css/admin_Style.css">
</head>

<?php
  // check if ID is provided
  if (isset($_GET['id'])) {
    $blogID = intval($_GET['id']);

    // another example to retrieve the existing product data using prepared statement
    $sql = "SELECT * FROM blog WHERE blogID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $blogID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
      $blogTitle = $row['blogTitle'];
      $blogEntry = $row['blogEntry'];
      $createdBy = $row['createdBy'];
      $blogDate = $row['blogDate'];
      $blogImg = $row['blogImg'];
    }
    else {
      echo "Blog not found.";
      exit;
    }
    mysqli_stmt_close($stmt);
  }
  else {
    echo "Invalid request.";
    exit;
  }

  // handle blog update form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blogTitle = $_POST['blogTitle'];
    $blogEntry = $_POST['blogEntry'];
    $createdBy = $_POST['createdBy'];
    $blogDate = $_POST['blogDate'];

    $uploadDir = '../../../blogUploads/';
    $blogImg = null;
    $image = null;

    // check if a new image is uploaded
    if (isset($_FILES['blogImg']) && $_FILES['blogImg']['error'] === UPLOAD_ERR_OK) {
      $tmpName = $_FILES['blogImg']['tmp_name'];
      $fileName = basename($_FILES['blogImg']['name']);
      $targetPath = $uploadDir . $fileName;

      // move the uploaded file
      if (move_uploaded_file($tmpName, $targetPath)) {
        $image = $fileName;

        // optional: delete the old image if necessary
        $sql = "SELECT blogImg FROM blog WHERE blogImg =?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $blogID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $blog = mysqli_fetch_assoc($result);

        if ($blog && $blog['blogImg'] && file_exists($uploadDir . $blog['blogImg'])) {
          unlink($uploadDir . $blog['blogImg']); // deletes the old image file
        }
        mysqli_stmt_close($stmt);
        echo $blogImg;
      }
    }
    
    if ($image) {
      // directory saved to DB
      $blogImg = "blogUploads/" . $image;
      // echo $blogImg;

      $sql = "UPDATE blog SET blogTitle = ?, blogEntry = ?, createdBy = ?, blogDate = ?, blogImg = ?
      WHERE blogID = ?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "ssissi", $blogTitle, $blogEntry, $createdBy, $blogDate, $blogImg, $blogID);
    }
    else {
      $sql = "UPDATE blog SET blogTitle = ?, blogEntry = ?, createdBy = ?, blogDate = ?
      WHERE blogID = ?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "ssisi", $blogTitle, $blogEntry, $createdBy, $blogDate, $blogID);
    }

    // execute query
    if (mysqli_stmt_execute($stmt)) {
      echo "
            <div id='blogSuccessMessage'>
              <p> ($blogTitle) with Blog ID of ($blogID) was edited successfully!</p>
              <a id='adminDashboardLink' href='" . ADMIN_BASE_URL . "'>
                Back to Admin Dashboard
              </a>
              <br>
              <a id='viewBlogList' href='admin_BlogList.php'>
                View Blog List
              </a>
              <br>
              <a id='createBlogLink' href='admin_BlogForm.php'>
                Create New Blog
              </a>
            </div>
          ";
    }
    else {
      echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
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

      <!-- BLOG EDIT SECTION STARTS HERE -->
      <!-- form edit title -->
      <h2 id="admin-formTitle">EDIT BLOG</h2>

      <!-- form edit details -->
      <div class="admin-blogForm">
        <form action="" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="blogID" value="<?= isset($blogID) ? htmlspecialchars($blogID) : 'NONE'; ?>">

        <label for="blogTitle">Blog Title:</label>
        <input type="text" id="blogTitle" name="blogTitle" value="<?= htmlspecialchars($blogTitle) ?>" required><br><br>

        <label for="blogEntry">Blog Entry:</label><br>
        <textarea id="blogEntry" name="blogEntry" rows="2" cols="50" required><?= htmlspecialchars($blogEntry) ?></textarea><br><br>
        
        <label for="createdBy">Created By:</label><br>
        <input type="hidden" id="createdBy" name="createdBy" value="<?php echo $_SESSION['UID']; ?>" readonly>
        <input type="text" value="<?php echo $adminName; ?>" readonly><br><br>

        <label for="blogDate">Blog Date:</label>
        <input type="date" id="blogDate" name="blogDate" value="<?= htmlspecialchars($blogDate) ?>" required><br><br>

        <label for="blog_image">Blog Image:</label><br>
        <img src="<?= BASE_URL . '/' . htmlspecialchars($blogImg) ?>" style="width:150px;height:150px;text-align: center;"><br><br>
        <input type="file" id="blogImg" name="blogImg" accept="image/*"><br><br>

        <button type="submit">Update</button>
        </form>
      </div>
      <!-- BLOG EDIT SECTION ENDS HERE -->
    </div>
  </section>
  <!-- ADMIN DASHBOARD SECTION ENDS HERE -->

  <!-- js file -->
  <script src="../../js/admin_Script.js"></script>
</body>