<!--
Matric Number: A180719
Name: Ivan Lee Wei Chong
-->
<?php
include_once 'database.php';
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
  <title>PowerFit Body Building Equipment and Supplement Shop : Products Details</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/index.css" rel="stylesheet">

    </head>

    <body>

      <?php

      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_products_a180719_pt2 WHERE fld_productID = :productID");
        $stmt->bindParam(':productID', $productID, PDO::PARAM_STR);
        $productID = $_GET['productID'];
        $stmt->execute();
        $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
      catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
      $conn = null;
      ?>

      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-8 col-md-offset-2 well well-sm text-center">
            <?php if ($readrow['fld_productImage'] == "" ) {
              echo "No image";
            }
            else { ?>
              <img src="products/<?php echo $readrow['fld_productImage'] ?>" class="img-responsive">
            <?php } ?>
          </div>
          <div class="col-xs-10 col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-1">
            <div class="panel panel-default">
              <div class="panel-heading"><strong>Product Details</strong></div>
              <div class="panel-body">
                Below are specifications of the product.
              </div>
              <table class="table">
                <tr>
                  <td class="col-xs-3 col-sm-6 col-md-6"><strong>Product ID</strong></td>
                  <td><?php echo $readrow['fld_productID'] ?></td>
                </tr>
                <tr>
                  <td><strong>Name</strong></td>
                  <td><?php echo $readrow['fld_productName'] ?></td>
                </tr>
                <tr>
                  <td><strong>Price</strong></td>
                  <td>RM <?php echo $readrow['fld_productPrice'] ?></td>
                </tr>
                <tr>
                  <td><strong>Brand</strong></td>
                  <td><?php echo $readrow['fld_productBrand'] ?></td>
                </tr>
                <tr>
                  <td><strong>Condition</strong></td>
                  <td><?php echo $readrow['fld_productCategory'] ?></td>
                </tr>
                <tr>
                  <td><strong>Manufacturing Year</strong></td>
                  <td><?php echo $readrow['fld_productRating'] ?></td>
                </tr>
                <tr>
                  <td><strong>Quantity</strong></td>
                  <td><?php echo $readrow['fld_productStock'] ?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/bootstrap.min.js"></script>
    </body>
    </html>