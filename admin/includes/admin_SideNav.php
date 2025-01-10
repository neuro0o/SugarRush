<!-- ADMIN SIDENAV SECTION STARTS HERE -->
<div class="sidenav">
  <a href="<?php echo ADMIN_BASE_URL; ?>/index.php" class="dashboard-link">
    DASHBOARD
  </a>

  <button class="dropdown-btn"> 
    <i class="fas fa-caret-right"></i> USER
  </button>
  <div class="dropdown-container">
    <a href="<?php echo ADMIN_BASE_URL; ?>/modules/user/admin_UserList.php">Manage User</a>
  </div>

  <button class="dropdown-btn"> 
    <i class="fas fa-caret-right"></i> CATEGORY
  </button>
  <div class="dropdown-container">
    <a href="<?php echo ADMIN_BASE_URL; ?>/modules/category/admin_CategoryForm.php">Create Category</a>
    <a href="<?php echo ADMIN_BASE_URL; ?>/modules/category/admin_CategoryList.php">Manage Category</a>
  </div>

  <button class="dropdown-btn"> 
    <i class="fas fa-caret-right"></i> PRODUCT
  </button>
  <div class="dropdown-container">
    <a href="<?php echo ADMIN_BASE_URL; ?>/modules/product/admin_ProductForm.php">Create Product</a>
    <a href="<?php echo ADMIN_BASE_URL; ?>/modules/product/admin_ProductList.php">Manage Product</a>
  </div>

  <button class="dropdown-btn"> 
    <i class="fas fa-caret-right"></i> BLOG
  </button>
  <div class="dropdown-container">
    <a href="<?php echo ADMIN_BASE_URL; ?>/modules/blog/admin_BlogForm.php">Create Blog</a>
    <a href="<?php echo ADMIN_BASE_URL; ?>/modules/blog/admin_BlogList.php">Manage Blog</a>
  </div>

  <button class="dropdown-btn"> 
    <i class="fas fa-caret-right"></i> REVIEW
  </button>
  <div class="dropdown-container">  
    <a href="<?php echo ADMIN_BASE_URL; ?>/modules/review/admin_ReviewList.php">Manage Review</a>
  </div>

  <a href="<?php echo BASE_URL; ?>/user/auth/logout.php" class="logout-button" title="Logout">
    <div class="logout-icon">
      LOGOUT <i class="fas fa-sign-out-alt" id="logout-icon"></i>
    </div>
  </a>
</div>
<!-- ADMIN SIDENAV SECTION ENDS HERE -->