<!-- include db config (admin_config.php) -->
<?php include("../../config/admin_config.php"); ?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN CATEGORY LIST</title>
  
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
      <!-- CATEGORY LIST SECTION STARTS HERE -->
      <!--form list title  -->
      <h2 id="admin-formTitle">CATEGORY LIST</h2>

      <!-- form list details -->
      <div class="admin-categoryListContainer">
        <?php
            // sql query to select category details
            $sql_category = "SELECT c.categoryID, c.categoryName, c.categoryDesc
            FROM category c
            ORDER BY c.categoryID ASC";

            // execute query on the database connection
            $result = mysqli_query($conn, $sql_category);

            // get the number of rows returned by the query
            $rowcount = mysqli_num_rows($result);
          ?>

          <!-- start of the table -->
          <table id="category-table">
          <tr>
            <th>CATEGORY ID</th>
            <th>CATEGORY NAME</th>
            <th>CATEGORY DESCRIPTION</th>
            <th>ACTIONS</th>
          </tr>

          <!-- dynamically create html table row based on output data of each row from category table -->
          <?php
            if ($rowcount > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["categoryID"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["categoryName"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["categoryDesc"]) . "</td>";
                echo "<td>";
                  echo "<a href='admin_EditCategory.php?id=" . urlencode($row["categoryID"]) . "'>Edit</a> | ";
                  echo "<a href='admin_DeleteCategory.php?id=" . urlencode($row["categoryID"]) . "' onclick='return confirm(\"Are you sure you want to delete this category?\");'>Delete</a>";
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
          <h2 id="list-row-count">Total Category: <?php echo $rowcount; ?></h2>
      </div>
      <!-- CATEGORY LIST SECTION ENDS HERE -->
    </div>
  </section>
  <!-- ADMIN DASHBOARD SECTION ENDS HERE -->

  <!-- js file -->
  <script src="../../js/admin_Script.js"></script>
  
</body>