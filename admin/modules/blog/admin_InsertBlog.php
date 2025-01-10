<?php
  // include db config
  include("../../config/admin_config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN INSERT BLOG</title>
  
  <!-- css file -->
  <link rel="stylesheet" href="../../css/admin_Style.css">
</head>

<body>
  <?php
    // handle form submission
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $blogTitle = mysqli_real_escape_string($conn, $_POST['blogTitle']);
      $blogEntry = mysqli_real_escape_string($conn, $_POST['blogEntry']);
      $createdBy = mysqli_real_escape_string($conn, $_POST['createdBy']);
      $blogDate = mysqli_real_escape_string($conn, $_POST['blogDate']);

      // handle image upload
      $target_dir = "../../../blogUploads/";
      $target_path = "blogUploads/";
      $target_file = $target_dir . basename($_FILES["blogImg"]["name"]);
      $target_fileDB = $target_path . basename($_FILES["blogImg"]["name"]);
      $upload_ok = 1;

      // check if image file is an actual image
      $check = getimagesize($_FILES["blogImg"]["tmp_name"]);
      if ($check !== false) {
        $upload_ok = 1;
      }
      else {
        echo "File is not an image.";
        $upload_ok = 0;
      }

      // move uploaded file to target directory
      if ($upload_ok && move_uploaded_file($_FILES["blogImg"]["tmp_name"], $target_file)) {

        $sql = "INSERT INTO blog (blogTitle, blogEntry, createdBy, blogDate, blogImg)
        VALUES ('$blogTitle', '$blogEntry', '$createdBy', '$blogDate', '$target_fileDB')";

        if (mysqli_query($conn, $sql)) {
          echo "
            <div id='blogSuccessMessage'>
              <p>NEW BLOG CREATED SUCCESSFULLY!</p>
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
          echo "<br>Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      }
      else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
    mysqli_close($conn);
  ?>
</body>