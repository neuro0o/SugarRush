<!-- USER HEADER SECTION STARTS HERE -->
<header class="header">

  <!-- logo container -->
  <div class="logo-content">
    <a href="" class="logo-image"><img src="<?php echo BASE_URL; ?>/user/img/logo.png" alt="logo"></a>
    <h1 class="logo-name">SUGAR RUSH</h1>
  </div>

  <!-- search bar container -->
  <div class="search-bar">
    <form action="<?php echo BASE_URL; ?>/user/function/user_Search.php" method="post">
        <input type="search" placeholder="Search Product" name="search_text" required>
        <button type="submit" aria-label="Search"><i class="fa fa-search"></i></button>
    </form>
  </div>

  <!-- icons container -->
  <div class="icons">
    <?php if (isset($_SESSION["UID"])) { ?>
      <span id="welcome-message">Welcome, <b><?php echo htmlspecialchars($_SESSION["userName"]); ?></b></span>
      <a href="<?php echo BASE_URL; ?>/user/auth/logout.php" class="logout-button" title="Logout">
        <div class="logout-icon">
          <i class="fas fa-sign-out-alt" id="logout-icon"></i>
        </div>
      </a>
    <?php } else { ?>
      <a href="javascript:void(0);" onclick="openLoginPopup()" class="login-button" title="Login">
        <div class="login-icon">
          <i class="fas fa-sign-in-alt" id="login-icon"></i>
        </div>
      </a>
    <?php } ?>
    
    <a href="cart_action.php" title="My Cart">
      <div class="cart-icon">
        <i class="fas fa-shopping-cart" id="cart-icon"></i>
        <?php
          if (isset($_SESSION["cart_item"])) {
            $countItem = count($_SESSION["cart_item"]);
            echo "<b>($countItem)</b>";
          } else {
            echo "<b id='cart-count'>(0)</b>";
          }
        ?>
      </div>
    </a>
  </div>

</header>
<!-- USER HEADER SECTION ENDS HERE -->