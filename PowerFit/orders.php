<!--
Matric Number: A180719
Name: Ivan Lee Wei Chong
-->
<?php
include_once 'orders_crud.php';
?>

<?php
include_once 'database.php';
if (!isset($_SESSION['isLogin']))
  header("Location: login.php");
?>

<!DOCTYPE html>
<html>
<head>
  <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>PowerFit Body Building Equipment and Supplement Shop : Orders</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/index.css" rel="stylesheet"> 

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>

      <?php include_once 'nav_bar.php'; ?>

      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="page-header">
              <h2>Create Order</h2>
            </div>

            <form action="orders.php" method="post" class="form-horizontal">
              <div class="form-group">
                <label for="orderid" class="col-sm-3 control-label">Order ID</label>
                <div class="col-sm-9"> 
                  <input name="orderID" type="text" class="form-control" id="orderid" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_orderID']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label for="orderdate" class="col-sm-3 control-label">Order Date</label>
                <div class="col-sm-9">  
                  <input name="orderDate" type="date" class="form-control" id="orderdate" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_orderDate']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label for="staffid" class="col-sm-3 control-label">Staff</label>
                <div class="col-sm-9">
                  <select name="staffID" class="form-control" id="staffid" required>
                    <?php
                    try {
                      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a180719_pt2");
                      $stmt->execute();
                      $result = $stmt->fetchAll();
                    }
                    catch(PDOException $e){
                      echo "Error: " . $e->getMessage();
                    }
                    foreach($result as $staffrow) {
                      ?>
                      <?php if((isset($_GET['edit'])) && ($editrow['fld_staffID']==$staffrow['fld_staffID'])) { ?>
                        <option value="<?php echo $staffrow['fld_staffID']; ?>" selected><?php echo $staffrow['fld_staffName'];?></option>
                      <?php } else { ?>
                        <option value="<?php echo $staffrow['fld_staffID']; ?>"><?php echo $staffrow['fld_staffName'];?></option>
                      <?php } ?>
                      <?php
        } // while
        $conn = null;
        ?>
      </select>
    </div>
  </div>


  <div class="form-group">
    <label for="customerid" class="col-sm-3 control-label">Customer</label>
    <div class="col-sm-9">
      <select name="customerID" class="form-control" id="customerid" required>
        <?php
        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_customers_a180719_pt2");
          $stmt->execute();
          $result = $stmt->fetchAll();
        }
        catch(PDOException $e){
          echo "Error: " . $e->getMessage();
        }
        foreach($result as $custrow) {
          ?>
          <?php if((isset($_GET['edit'])) && ($editrow['fld_customerID']==$custrow['fld_customerID'])) { ?>
            <option value="<?php echo $custrow['fld_customerID']; ?>" selected><?php echo $custrow['fld_customerName'];?></option>
          <?php } else { ?>
            <option value="<?php echo $custrow['fld_customerID']; ?>"><?php echo $custrow['fld_customerName'];?></option>
          <?php } ?>
          <?php
        } // while
        $conn = null;
        ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <?php if (isset($_GET['edit'])) { ?>
        <input type="hidden" name="oldorderid" value="<?php echo $editrow['fld_orderID']; ?>">
        <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>
      <?php } else { ?>
        <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create</button>
      <?php } ?>
      <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Clear</button>
    </div>
  </div>
</form>
</div>
</div>

<div class="row">
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
    <div class="page-header">
      <h2>Order List</h2>
    </div>
    <table class="table table-striped table-bordered">
      <tr>
        <th>Order ID</th>
        <th>Order Date</th>
        <th>Staff ID</th>
        <th>Customer ID</th>
        <th>Action</th>
      </tr>
      <?php
      $per_page = 7;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_orders_a180719, tbl_staffs_a180719_pt2, tbl_customers_a180719_pt2 WHERE ";
        $sql = $sql."tbl_orders_a180719.fld_staffID = tbl_staffs_a180719_pt2.fld_staffID and ";
        $sql = $sql."tbl_orders_a180719.fld_customerID = tbl_customers_a180719_pt2.fld_customerID LIMIT $start_from, $per_page";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
        echo "Error: " . $e->getMessage();
      }
      foreach($result as $orderrow) {
        ?>
        <tr>
          <td><?php echo $orderrow['fld_orderID']; ?></td>
          <td><?php echo $orderrow['fld_orderDate']; ?></td>
          <td><?php echo $orderrow['fld_staffName']; ?></td>
          <td><?php echo $orderrow['fld_customerName']; ?></td>
          <td>
            <a href="orders_details.php?orderID=<?php echo $orderrow['fld_orderID']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
            <?php if($_SESSION['userLoginPosition']['fld_staffPosition'] == 'Admin' || $_SESSION['userLoginPosition']['fld_staffPosition'] == 'Supervisor') { ?>
            <a href="orders.php?edit=<?php echo $orderrow['fld_orderID']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
            <a href="orders.php?delete=<?php echo $orderrow['fld_orderID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
            <?php } ?>
          </td>
        </tr>
      <?php } ?>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
    <nav>
      <ul class="pagination">
        <?php
        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_orders_a180719");
          $stmt->execute();
          $result = $stmt->fetchAll();
          $total_records = count($result);
        }
        catch(PDOException $e){
          echo "Error: " . $e->getMessage();
        }
        $total_pages = ceil($total_records / $per_page);
        ?>
        <?php if ($page==1) { ?>
          <li class="disabled"><span aria-hidden="true">«</span></li>
        <?php } else { ?>
          <li><a href="orders.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
        }
        for ($i=1; $i<=$total_pages; $i++)
          if ($i == $page)
            echo "<li class=\"active\"><a href=\"orders.php?page=$i\">$i</a></li>";
          else
            echo "<li><a href=\"orders.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="orders.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>