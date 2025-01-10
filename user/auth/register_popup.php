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
  <title>REGISTER POPUP</title>
  
  <!-- cdn icon link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- css file -->
  <link rel="stylesheet" href="../css/user_Style.css">
</head>

<body>
  <div id="reg-popup" class="reg-popup">
    <span class="close-btn" onclick="closeRegPopup()">&times;</span>
    <h3>USER REGISTRATION</h3><br>

    <form action="<?php echo BASE_URL; ?>/user/auth/register_action.php" method="post">

      <label for="reguserName">Username:</label><br>
      <input type="text" id="reguserName" name="userName" required><br><br>

      <label for="reguserEmail">User Email:</label><br>
      <input type="email" id="reguserEmail" name="userEmail" required><br><br>

      <label for="reguserPwd">Password:</label><br>
      <input type="password" id="reguserPwd" name="userPwd" required maxlength="8"><br><br>

      <label for="regconfirmPwd">Confirm Password:</label><br>
      <input type="password" id="regconfirmPwd" name="confirmPwd" required><br><br><br>

      <button type="submit" value="Register">Register</button>
      <button type="reset" value="Reset">Reset</button><br>

    </form>
  </div>

  <!-- overlay -->
  <div id="overlay" class="overlay" onClick="closeRegPopup()"></div>
</body>