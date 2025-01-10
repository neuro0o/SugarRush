<!-- include db config (admin_config.php) -->
<?php include("../../config/admin_config.php"); ?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN BLOG LIST</title>
  
  <!-- cdn icon link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- css file -->
  <link rel="stylesheet" href="../../css/admin_Style.css">
</head>

<body>
  <!-- ADMIN SIDENAV SECTION STARTS HERE -->
  <?php include("../../includes/admin_SideNav.php"); ?>
  <!-- ADMIN SIDENAV SECTION ENDS HERE -->

  <!-- ADMIN DASHBOARD SECTION STARTS HERE -->
  <section class="admin-dashboard">
    <div class="dashboard-container">

      <!-- BLOG LIST SECTION STARTS HERE -->
      <!-- form list title -->
      <h2 id="admin-formTitle">BLOG LIST</h2>

      <!-- form list details   -->
       <div class="admin-blogListContainer">
        <?php
          // sql query to select blog details
          $sql_blog = "SELECT b.blogID, b.blogTitle, b.blogEntry, b.blogImg, b.createdBy, b.blogDate
          FROM blog b
          ORDER BY b.blogID ASC";

          // execute query on the database connection
          $result = mysqli_query($conn, $sql_blog);

          // get the number of rows returned by the query
          $rowcount = mysqli_num_rows($result);
        ?>

        <!-- start of the table -->
        <table id="blog-table">
          <tr>
            <th>BLOG ID</th>
            <th>BLOG TITLE</th>
            <th>BLOG ENTRY</th>
            <th>BLOG DATE</th>
            <th>ACTIONS</th>
          </tr>

        <!-- dynamically create html table row based on output data of each row from blog table -->
        <?php
          if ($rowcount > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row["blogID"]) . "</td>";
              echo "<td>" . htmlspecialchars($row["blogTitle"]) . "</td>";
              echo "<td>" . htmlspecialchars($row["blogEntry"]) . "</td>";
              echo "<td>" . htmlspecialchars($row["blogDate"]) . "</td>";

              echo "<td>";
                    echo "<a href='admin_EditBlog.php?id=" . urlencode($row["blogID"]) . "'>Edit</a> | ";
                    echo "<a href='admin_DeleteBlog.php?id=" . urlencode($row["blogID"]) . "' onclick='return confirm(\"Are you sure you want to delete this blog?\");'>Delete</a>";
                  echo "</td>";
            }
          }
          else {
            echo "<p>No results found.</p>";
          }

          // free result set
          mysqli_free_result($result);
          // close connection
          mysqli_close($conn);
        ?>
      </table>
        <!-- display row count -->
        <h2 id="list-row-count">Total Blog: <?php echo $rowcount; ?></h2>
       </div>
    </div>
    <!-- BLOG LIST SECTION ENDS HERE -->
  </section>
  <!-- ADMIN DASHBOARD SECTION ENDS HERE -->

  <!-- js file -->
  <script src="../../js/admin_Script.js"></script>
</body>