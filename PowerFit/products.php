<!--
Matric Number: A180719
Name: Ivan Lee Wei Chong
-->
<?php
include_once 'products_crud.php';
?>

<?php
include_once 'database.php';
if (!isset($_SESSION['isLogin']))
  header("Location: login.php");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>PowerFit Body Building Equipment and Supplement Shop : Products</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/index.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap4.min.js"></script> 
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>         
  <script src="js/bootstrap.min.js"></script> 

  <script>$(document).ready(function () {
    $('[id*="detailbtn"]').on('click', function(){
      var dataURL=$(this).attr('data-href');
      $('.modal-body').load(dataURL, function(){
        $('#productDetailModal').modal({show:true});
      });   
    });
    $('#products').DataTable({
      lengthMenu: [
        [5, 10, 20, 30, -1],
        [5, 10, 20, 30, 'All'],
        ],
      "dom": 'lBfrtip',
      "buttons": ['excel']
    });
  });
</script>
</head>
  
<body>
  <?php include_once 'nav_bar.php'; ?>
  <div class="container-fluid">
    <?php if($_SESSION['userLoginPosition']['fld_staffPosition'] == 'Admin' || $_SESSION['userLoginPosition']['fld_staffPosition'] == 'Supervisor') { ?>
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="page-header">
          <h2>Product Information</h2>
        </div>

        <form action="products.php" method="post" class="form-horizontal">
          <div class="form-group">
            <label for="productid" class="col-sm-3 control-label">Product ID</label>
            <div class="col-sm-9">
              <input name="productID" placeholder="Insert product ID" type="text" class="form-control" id="productid" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_productID']; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label for="productname" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-9"> 
              <input name="productName" placeholder="Insert product name" type="text" class="form-control" id="productname" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_productName']; ?>" required>
            </div>
          </div>


          <div class="form-group">
            <label for="productprice" class="col-sm-3 control-label">Price (RM)</label>
            <div class="col-sm-9"> 
              <input name="productPrice" placeholder="Insert product price" type="number" class="form-control" id="productprice" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_productPrice']; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label for="productbrand" class="col-sm-3 control-label">Brand</label>
            <div class="col-sm-9">
              <select name="productBrand" class="form-control" id="productbrand" required>
                <option value="">Please select a brand</option>
                <option value="BODYTECH" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="BODYTECH") echo "selected"; ?>>BODYTECH</option>
                <option value="BOSWELL" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="BOSWELL") echo "selected"; ?>>Boswell</option>
                <option value="BPI Sports <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="BPI Sports") echo "selected"; ?>">BPI Sports</option>
                <option value="BSN" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="BSN") echo "selected"; ?>>BSN</option>
                <option value="Calister Fitness" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="Calister Fitness") echo "selected"; ?>>Calister Fitness</option>
                <option value="CELEBRITA" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="CELEBRITA") echo "selected"; ?>>CELEBRITA</option>
                <option value="Cellucor" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="Cellucor") echo "selected"; ?>>Cellucor</option>
                <option value="Dmoose" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="Dmoose") echo "selected"; ?>>Dmoose</option>
                <option value="DOMYOS" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="DOMYOS") echo "selected"; ?>>DOMYOS</option>
                <option value="EnterSports" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="EnterSports") echo "selected"; ?>>EnterSports</option>
                <option value="FLYBIRD" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="FLYBIRD") echo "selected"; ?>>FLYBIRD</option>
                <option value="Hawk Sports" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="Hawk Sports") echo "selected"; ?>>Hawk Sports</option>
                <option value="INSPIRE" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="INSPIRE") echo "selected"; ?>>INSPIRE</option>
                <option value="Mazzello" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="Mazzelo") echo "selected"; ?>>Mazzello</option>
                <option value="MusclePharm" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="MusclePharm") echo "selected"; ?>>MusclePharm</option>
                <option value="Nice C" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="Nice C") echo "selected"; ?>>Nice C</option>
                <option value="NYAMBA" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="NYAMBA") echo "selected"; ?>>NYAMBA</option>
                <option value="Optimum Nutrition" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="Optimum Nutrition") echo "selected"; ?>>Optimum Nutrition</option>
                <option value="PANMAX" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="PANMAX") echo "selected"; ?>>PANMAX</option>
                <option value="Pelpo" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="Pelpo") echo "selected"; ?>>Pelpo</option>
                <option value="Perfect Fitness" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="Perfect Fitness") echo "selected"; ?>>Perfect Fitness</option>
                <option value="PINROYAL" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="PINROYAL") echo "selected"; ?>>PINROYAL</option>
                <option value="Redipo" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="Redipo") echo "selected"; ?>>Redipo</option>
                <option value="RuiDa" <?php if(isset($_GET['edit'])) if($editrow['fld_productBrand']=="RuiDa") echo "selected"; ?>>RuiDa</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="productcategory" class="col-sm-3 control-label">Category</label>
            <div class="col-sm-9">
              <select name="productCategory" class="form-control" id="productcategory" required>
                <option value="">Please select a category</option>
                <option value="Ab Roller" <?php if(isset($_GET['edit'])) if($editrow['fld_productCategory']=="Ab Roller") echo "selected"; ?>>Ab Roller</option>
                <option value="Arm Blaster" <?php if(isset($_GET['edit'])) if($editrow['fld_productCategory']=="Ab Blaster") echo "selected"; ?>>Arm Blaster</option>
                <option value="Creatine" <?php if(isset($_GET['edit'])) if($editrow['fld_productCategory']=="Creatine") echo "selected"; ?>>Creatine</option>
                <option value="Dumbbell" <?php if(isset($_GET['edit'])) if($editrow['fld_productCategory']=="Dumbbell") echo "selected"; ?>>Dumbbell</option>
                <option value="Pre-Workout Supplement" <?php if(isset($_GET['edit'])) if($editrow['fld_productCategory']=="Pre-Workout Supplement") echo "selected"; ?>>Pre-Workout Supplement</option>
                <option value="Push Up Bar" <?php if(isset($_GET['edit'])) if($editrow['fld_productCategory']=="Push Up Bar") echo "selected"; ?>>Push Up Bar</option>
                <option value="Testerone Booster" <?php if(isset($_GET['edit'])) if($editrow['fld_productCategory']=="Testerone Booster") echo "selected"; ?>>Testerone Booster</option>
                <option value="Weight Bench" <?php if(isset($_GET['edit'])) if($editrow['fld_productCategory']=="Weight Bench") echo "selected"; ?>>Weight Bench</option>
              </select>
            </div>
          </div> 

          <div class="form-group">
            <label for="productrating" class="col-sm-3 control-label">Rating</label>
            <div class="col-sm-9">
              <div class="radio">
                <label> 
                  <input name="productRating" type="radio" id="productrating" value="1" <?php if(isset($_GET['edit'])) if($editrow['fld_productRating']=="1") echo "checked"; ?> required > 1
                </label>
              </div>
              <div class="radio">
                <label>
                  <input name="productRating" type="radio" id="productrating" value="2" <?php if(isset($_GET['edit'])) if($editrow['fld_productRating']=="2") echo "checked"; ?>> 2
                </label>
              </div>
              <div class="radio">
                <label>
                  <input name="productRating" type="radio" id="productrating" value="3" <?php if(isset($_GET['edit'])) if($editrow['fld_productRating']=="3") echo "checked"; ?>> 3
                </label>
              </div>
              <div class="radio">
                <label>
                  <input name="productRating" type="radio" id="productrating" value="4" <?php if(isset($_GET['edit'])) if($editrow['fld_productRating']=="4") echo "checked"; ?>> 4
                </label>
              </div>
              <div class="radio">
                <label>
                  <input name="productRating" type="radio" id="productrating" value="5" <?php if(isset($_GET['edit'])) if($editrow['fld_productRating']=="5") echo "checked"; ?>> 5
                </label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="productq" class="col-sm-3 control-label">Quantity</label>
            <div class="col-sm-9"> 
              <input name="productStock" placeholder="Insert product stock" type="number" class="form-control" id="productq" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_productStock']; ?>" min="0" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <?php if (isset($_GET['edit'])) { ?>
                <input type="hidden" name="productOldID" value="<?php echo $editrow['fld_productID']; ?>">
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
  <?php } ?>

<div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <div class="page-header">
          <h2>Products List</h2>
        </div>
        <table id="products" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Product ID</th>
              <th>Name</th>
              <th>Price (RM)</th>
              <th>Brand</th>
              <th>Rating</th>
              <th>Stock</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Fetch Product List from DB -->
          <?php
            try {
              $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $conn->prepare("SELECT * FROM tbl_products_a180719_pt2");
              $stmt->execute();
              $result = $stmt->fetchAll();
            }
            catch(PDOException $e){
              echo "Error: " . $e->getMessage();
            }
          foreach($result as $readrow) {
          ?>   
          <tr>
            <td><?php echo $readrow['fld_productID']; ?></td>
            <td><?php echo $readrow['fld_productName']; ?></td>
            <td><?php echo $readrow['fld_productPrice']; ?></td>
            <td><?php echo $readrow['fld_productBrand']; ?></td>
            <td><?php echo $readrow['fld_productRating']; ?></td>
            <td><?php echo $readrow['fld_productStock']; ?></td>
            <td>
              <a id="detailbtn" data-href="products_details.php?productID=<?php echo $readrow['fld_productID']; ?>" class="btn btn-warning btn-xs" role="button"> Details </a>
              <?php if($_SESSION['userLoginPosition']['fld_staffPosition'] == 'Admin' || $_SESSION['userLoginPosition']['fld_staffPosition'] == 'Supervisor') { ?>
              <a href="products.php?edit=<?php echo $readrow['fld_productID']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
              <a href="products.php?delete=<?php echo $readrow['fld_productID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
              <?php } ?>
            </td>
          </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

    <div class="modal fade" id="productDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: Open Sans;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Product Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    </body>
    </html>