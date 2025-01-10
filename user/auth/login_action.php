<?php
  session_start();
  // include db config
  include __DIR__ . '/../config/user_config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN ACTION</title>
  
  <!-- cdn icon link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- css file -->
  <link rel="stylesheet" href="../css/user_Style.css">
</head>

<body>

  <?php
    // get login values from login form
    $userEmail = mysqli_real_escape_string($conn, $_POST['userEmail']);
    $userPwd = mysqli_real_escape_string($conn, $_POST['userPwd']);

    $sql = "SELECT * FROM user WHERE userEmail='$userEmail' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {	
      // check password hash
      $row = mysqli_fetch_assoc($result);
      if (password_verify($userPwd, $row['userPwd'])) {
          echo '<script type="text/javascript">		
                  alert("Login successful!");
                </script>';
        
        // set session variables
        $_SESSION["UID"] = $row["userID"];
        $_SESSION["userName"] = $row["userName"];
        $_SESSION["userRoles"] = $row["userRoles"];
        $_SESSION['loggedin_time'] = time();  
        
        // redirect based on user role
        if ($row['userRoles'] == 1) { // owner/admin
          echo '<script type="text/javascript">
                  window.location.href = "' . ADMIN_BASE_URL . '/index.php";
                </script>';
        }
        elseif ($row['userRoles'] == 2) { // normal user
          echo '<script type="text/javascript">
                  window.location.href = "' . BASE_URL . '/index.php";
                </script>';
        }
        else { // unknown user/role
          echo '<script type="text/javascript">
                  alert("Unknown user role.");
                  window.location.href = "' . BASE_URL . '/index.php";
                </script>';
        }
        exit();	
      }
      else {
        echo 'Login error, user email and password are incorrect.<br>';
        echo '<a href="' . BASE_URL . '/index.php"> | BACK |</a> &nbsp;&nbsp;&nbsp; <br>';
      }		
    }
    else {
      echo "Login error, user <b>$userEmail</b> does not exist. <br>";
      echo '<a href="' . BASE_URL . '/index.php"> | BACK |</a>&nbsp;&nbsp;&nbsp; <br>';	
    } 
    mysqli_close($conn);
  ?>
</body>