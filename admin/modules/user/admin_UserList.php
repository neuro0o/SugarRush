<!-- include db config (admin_config.php) -->
<?php include("../../config/admin_config.php"); ?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN USER LIST</title>
  
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
      <!-- USER LIST SECTION STARTS HERE -->
      <!-- form lis title -->
      <h2 id="admin-formTitle">USER LIST</h2>

      <!-- form list details -->
      <div class="admin-userListContainer">
        <?php
          // sql query to select user details
          $sql_user = "SELECT u.userID, u.userName, u.userEmail, u.regDate, u.userRoles
          FROM user u
          ORDER BY u.userID ASC";

          // execute query on the database connection
          $result = mysqli_query($conn, $sql_user);

          // get the number of rows returned by the query
          $rowcount = mysqli_num_rows($result);
        ?>

        <!-- start of the table -->
        <table id="user-table">
          <tr>
            <th>USER ID</th>
            <th>USERNAME</th>
            <th>USER EMAIL</th>
            <th>ROLE</th>
            <th>REGISTER DATE</th>
            <th>ACTIONS</th>
          </tr>

          <!-- dynamically create html table row based on output data of each row from user table -->
          <?php 
            if ($rowcount > 0 ) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["userID"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["userName"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["userEmail"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["userRoles"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["regDate"]) . "</td>";
                echo "<td>";
                echo "<a href='admin_EditUser.php?id=" . urlencode($row["userID"]) . "'>Edit</a> | ";
                echo "<a href='admin_DeleteUser.php?id=" . urlencode($row["userID"]) . "' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>";
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
        <h2 id="list-row-count">( 1: ADMIN | 2: USER )</h2>
        <h2 id="list-row-count">Total User: <?php echo $rowcount; ?></h2>
      </div>
      <!-- USER LIST SECTION ENDS HERE -->
    </div>
  </section>
  <!-- ADMIN DASHBOARD SECTION ENDS HERE -->
  
  <!-- js file -->
  <script src="../../js/admin_Script.js"></script>
</body>