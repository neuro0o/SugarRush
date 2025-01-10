<!-- LOGIN POPUP SECTION STARTS HERE -->
<div id="login-popup" class="login-popup">      
  <span class="close-btn" onClick="closeLoginPopup()">&times;</span>
  <h3>USER LOGIN</h3><br>

  <form action="<?php echo BASE_URL; ?>/user/auth/login_action.php" method="post">    <label for="userEmail">User Email:</label><br>
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
<!-- LOGIN POPUP SECTION ENDS HERE -->

<!-- REGISTER POPUP SECTION STARTS HERE -->
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
<!-- REGISTER POPUP SECTION ENDS HERE -->