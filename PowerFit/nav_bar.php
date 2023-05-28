<nav class="navbar navbar-dark bg-primary" style="height: 70px;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header"style="margin-top: 10px;">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="color: white; font-size: 20px" href="index.php">PowerFit Body Building Equipment and Supplement Shop</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="margin-top: 10px">
      <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" style="color: white; font-size: 18px;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="products.php">Products</a></li>
          <li><a href="customers.php">Customers</a></li>
          <?php if($_SESSION['userLoginPosition']['fld_staffPosition'] == 'Admin' || $_SESSION['userLoginPosition']['fld_staffPosition'] == 'Supervisor') { ?>
          <li><a href="staffs.php">Staffs</a></li>
          <?php } ?>
          <li><a href="orders.php">Orders</a></li>
          <li><a href="?logout=1" name="logout">Log out</a>
            <?php
            if(isset($_GET['logout'])) {
              if($_GET['logout'] == '1') {
                session_start();
                session_destroy();
                header("Location: login.php");
              }
            }
            ?>
          </li>
        </ul>
      </li>
    </ul>
      <ul class="nav navbar-nav navbar-right">
        <a class="navbar-brand" style="color: white; text-align: center;" id="userPosition">User: <?php echo $_SESSION['userLoginPosition']['fld_staffName'].' ('.$_SESSION['userLoginPosition']['fld_staffPosition'].')'?>
      </a>
    </ul>
    
  </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>