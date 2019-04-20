<header class="header-section">
  <div class="header-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-2 text-center text-lg-left">
          <!-- logo -->
          <a href="./index.php" class="site-logo">
            <img src="img/logo.png" alt="">
          </a>
        </div>
        <div class="col-xl-6 col-lg-5">
          <form class="header-search-form">
            <input type="text" placeholder="Search on SubscribeMe ....">
            <button><i class="flaticon-search"></i></button>
          </form>
        </div>
        <div class="col-xl-4 col-lg-5">
          <div class="user-panel">
            <div class="up-item">
              <li>
                <i class="flaticon-profile"></i>
                  <?php
                  $user = new User();
                  if($user->isLoggedIn()){
    								echo "<a href class='logged-in'>Welcome, " . escape($user->data()->name) ."!";
                    ?>
                  </a>
                    <ul class="sub-menu">
                      <li><a href="update.php">Update Your Account</a></li>
                      <li><a href="orders.php">Your Orders</a></li>
                      <li><a href="payment.php">Payment</a></li>
                      <?php
                      if($user->hasPermission('admin')){ //TODO: Update with better permissions system
                        echo "<li><a href=\"https://admin.subscribme.shop\">Admin Control Panel</a></li>";
                      }
                      ?>
                      <li><a href="logout.php">Sign Out</a></li>
                    </ul>
                  </li>
                <?php
							} else {
                ?>
                <a href="login.php">Sign In</a> or <a href="register.php">Create Account</a>
                <?php
              }
              ?>
            </div>
            <div class="up-item">
              <div class="shopping-card">
                <i class="flaticon-bag"></i>
                <span>0</span>
              </div>
              <a href="cart.php">Shopping Cart</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <nav class="main-navbar">
    <div class="container">
      <!-- menu -->
      <ul class="main-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="category.php?cat=1">Outdoor</a></li>
        <li><a href="category.php?cat=2">Self-Care<span class="new">New</span></a></li>
        <li><a href="category.php?cat=3">Trending</a></li>
        <li><a href="category.php?cat=4">Gifts</a>
          <ul class="sub-menu">
            <li><a href="category.php?cat=5">Holday</a></li>
            <li><a href="category.php?cat=5">Birthday</a></li>
            <li><a href="category.php?cat=5">Graduation</a></li>
            <li><a href="category.php?cat=5">Surprise</a></li>
            <li><a href="category.php?cat=5">Misc.</a></li>
          </ul>
        </li>
        <li><a href="category.php?cat=6">Kids</a></li>
        <li><a href="category.php?cat=7">Modern</a></li>
        <li><a href="category.php?cat=8">Consumable</a></li>
        <li><a href="category.php?cat=9">Fitness</a></li>
        <li><a href="category.php?cat=10">Miscellaneous</a></li>
      </ul>
    </div>
  </nav>
</header>
