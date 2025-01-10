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
  <title>ADMIN EDIT USER</title>
  
  <!-- cdn icon link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- css file -->
  <link rel="stylesheet" href="../../css/admin_Style.css">
</head>

<?php
  // check if ID is provided
  if (isset($_GET['id'])) {
    $userID = intval($_GET['id']);

    // another example to retrieve the existing category data using prepared statement
    $sql = "SELECT * FROM user WHERE userID =?";
    $stmt_select = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt_select, "i", $userID);
    mysqli_stmt_execute($stmt_select);
    $result = mysqli_stmt_get_result($stmt_select);

    if ($row = mysqli_fetch_assoc($result)) {
      $userName = $row['userName'];
      $userEmail = $row['userEmail'];
      $userRoles = $row['userRoles'];
      $regDate = $row['regDate'];
    }
    else {
      echo "User not found.";
      exit;
    }
    mysqli_stmt_close($stmt_select);
  }
  else {
    echo "Invalid Request.";
    exit;
  }

  // fetch roles from database
  $roles = [];
  $sql_roles = "SELECT userRoles FROM user";
  $result_roles = mysqli_query($conn, $sql_roles);
  while ($row = mysqli_fetch_assoc($result_roles)) {
    $roles[] = $row; 
  }

  // define roles mapping
  $roles = [
    1 => 'Admin',
    2 => 'User'
  ];

  // handle user update form submission
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $userRoles = $_POST['userRoles'];
    $regDate = $_POST['regDate'];

    // check if new password is provided
    if (!empty($_POST['userPwd']) && !empty($_POST['confirmPwd'])) {
      $userPwd = $_POST['userPwd'];
      $confirmPwd =$_POST['confirmPwd'];

      // validate password and confirm password
      if ($userPwd !== $confirmPwd) {
        echo "<p> Error: Password and confirm password do not match. </p>";
        exit;
      }

      // hash password
      $pwdHash = password_hash($userPwd, PASSWORD_DEFAULT);

      // update user with new password
      $sql_update = "UPDATE user SET userName = ?, userEmail = ?, userRoles = ?, regDate = ?, userPwd = ?
      WHERE userID = ?";
      $stmt_update = mysqli_prepare($conn, $sql_update);
      mysqli_stmt_bind_param($stmt_update, "ssissi", $userName, $userEmail, $userRoles, $regDate, $pwdHash, $userID);
    }
    else {
      // update user without changing password
      $sql_update = "UPDATE user SET userName = ?, userEmail = ?, userRoles = ?, regDate = ?
      WHERE userID = ?";
      $stmt_update = mysqli_prepare($conn, $sql_update);
      mysqli_stmt_bind_param($stmt_update, "ssisi", $userName, $userEmail, $userRoles, $regDate, $userID);
    }

    // execute query
    if (mysqli_stmt_execute($stmt_update)) {
        echo "
            <div id='userSuccessMessage'>
                <p> ($userName) with User ID of ($userID) was edited successfully!</p>
                <a id='adminDashboardLink' href='" . ADMIN_BASE_URL . "'>
                    Back to Admin Dashboard
                </a>
                <br>
                <a id='viewUserList' href='admin_UserList.php'>
                    View User List
                </a>
                <br>
            </div>
        ";
    } else {
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

      <!-- USER EDIT SECTION STARTS HERE -->
      <!-- form edit title -->
      <h2 id="admin-formTitle">EDIT USER</h2>

      <!-- form edit details -->
      <div class="admin-userForm">
        <form action="" method="POST">

          <input type="hidden" name="userID" value="<?= isset($userID) ? htmlspecialchars($userID) : 'NONE'; ?>">

          <label for="userName">User Name:</label>
          <input type="text" id="userName" name="userName" value="<?= htmlspecialchars($userName) ?>" required><br><br>

          <label for="userName">User Email:</label>
          <input type="text" id="userEmail" name="userEmail" value="<?= htmlspecialchars($userEmail) ?>" required><br><br>

          <label for="userPwd">New Password:</label>
          <input type="password" id="userPwd" name="userPwd"><br><br>

          <label for="confirmPwd">Confirm New Password:</label>
          <input type="password" id="confirmPwd" name="confirmPwd"><br><br>

          <label for="userRoles">User  Role:</label>
          <select id="userRoles" name="userRoles" required>
            <option value="" disabled selected>-- select role --</option>
            <?php foreach ($roles as $roleID => $roleName): ?>
            <option value="<?= htmlspecialchars($roleID) ?>" <?= ($userRoles == $roleID) ? : ''; ?>>
              <?= htmlspecialchars($roleName) ?>
            </option>
            <?php endforeach; ?>
          </select><br><br>

          <label for="regDate">Register Date:</label>
          <input type="date" id="regDate" name="regDate" value="<?= htmlspecialchars($regDate) ?>" required><br><br>

          <button type="submit">Update</button>
        </form>
      </div>
      <!-- USER EDIT SECTION ENDS HERE -->
    </div>
  </section>
  <!-- ADMIN DASHBOARD SECTION ENDS HERE -->

  <!-- js file -->
  <script src="../../js/admin_Script.js"></script>
</body>
