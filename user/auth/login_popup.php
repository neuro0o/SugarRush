<?php
  // include db config
  include __DIR__ . '/../config/user_config.php';
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN POPUP</title>
  
  <!-- cdn icon link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- css file -->
  <link rel="stylesheet" href="../css/user_Style.css">
</head>

<body>
  <div id="login-popup" class="login-popup">
      
    <span class="close-btn" onClick="closeLoginPopup()">&times;</span>
    <h3>USER LOGIN</h3><br>

    <form action="<?php echo BASE_URL; ?>/user/auth/login_action.php" method="post">

      <label for="userEmail">User Email:</label><br>
      <input type="email" id="userEmail" name="userEmail" required><br><br>

      <label for="userPwd">Password:</label><br>
      <input type="password" id="userPwd" name="userPwd" required maxlength="8" autocomplete="off"><br><br><br>

      <button type="submit" value="Login">Login</button>
      <button type="reset" value="Reset">Reset</button><br>

    </form>

      <p><a href="javascript:void(0);" onClick="openRegPopup();">Register | Forgot Password </a>

  </div>

  <!-- overlay -->
  <div id="overlay" class="overlay" onClick=closeLoginPopup();></div>
</body>