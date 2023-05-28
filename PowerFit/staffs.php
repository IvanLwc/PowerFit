<!--
Matric Number: A180719
Name: Ivan Lee Wei Chong
-->
<?php
include_once 'staffs_crud.php';
?>

<?php
include_once 'database.php';
if (!isset($_SESSION['isLogin']))
  header("Location: login.php");
?>

<?php
if ($_SESSION['userLoginPosition']['fld_staffPosition'] == 'Staff' )
  header("Location: index.php");
?>

<!DOCTYPE html>
<html>
<head>
  <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>PowerFit Body Building Equipment and Supplement Shop : Staffs</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/index.css" rel="stylesheet"> 

    </head>
    <body>

      <?php include_once 'nav_bar.php'; ?>

      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="page-header">
              <h2>Staff Information</h2>
            </div>

            <form action="staffs.php" method="post" class="form-horizontal">
              <div class="form-group">
                <label for="staffid" class="col-sm-3 control-label">Staff ID</label>
                <div class="col-sm-9"> 
                  <input name="staffID" type="text" placeholder="Insert staff ID" class="form-control" id="staffid" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staffID']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label for="staffname" class="col-sm-3 control-label">Staff Name</label>
                <div class="col-sm-9"> 
                  <input name="staffName" type="text" placeholder="Insert staff name" class="form-control" id="staffname" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staffName']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label for="staffphonenumber" class="col-sm-3 control-label">Staff's Phone Number</label>
                <div class="col-sm-9">  
                  <input name="staffPhoneNumber" type="text" placeholder="0#########" class="form-control" id="staffphonenumber "value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staffPhoneNumber']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label for="staffemail" class="col-sm-3 control-label">Staff Email</label>
                <div class="col-sm-9"> 
                  <input name="staffEmail" type="text" placeholder="Insert staff email" class="form-control" id="staffemail" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staffEmail']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label for="staffpassword" class="col-sm-3 control-label">Staff Password</label>
                <div class="col-sm-9"> 
                  <input name="staffPassword" type="text" placeholder="Insert staff password" class="form-control" id="staffpassword" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staffPassword']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label for="staffposition" class="col-sm-3 control-label">Staff Position</label>
                <div class="col-sm-9">
                  <select name="staffPosition" class="form-control" id="staffposition" required>
                    <option value="">Select Position</option>
                    <option value="Admin" <?php if(isset($_GET['edit'])) if($editrow['fld_staffPosition']=="Admin") echo "selected"; ?>>Admin</option>
                    <option value="Supervisor" <?php if(isset($_GET['edit'])) if($editrow['fld_staffPosition']=="Supervisor") echo "selected"; ?>>Supervisor</option>
                    <option value="Staff" <?php if(isset($_GET['edit'])) if($editrow['fld_staffPosition']=="Staff") echo "selected"; ?>>Staff</option>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <?php if (isset($_GET['edit'])) { ?>
                    <input type="hidden" name="staffOldID" value="<?php echo $editrow['fld_staffID']; ?>">
                    <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>
                  <?php } else { ?>
                    <?php if($_SESSION['userLoginPosition']['fld_staffPosition'] == 'Admin') { ?>
                    <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create</button>
                    <?php } ?>
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
              <h2>Staff List</h2>
            </div>
            <table class="table table-striped table-bordered">
              <tr>
                <th>Staff ID</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Password</th>
                <th>Position</th>
                <th>Action</th>
              </tr>
              <?php
      // Read
              $per_page = 7;
              if (isset($_GET["page"]))
                $page = $_GET["page"];
              else
                $page = 1;
              $start_from = ($page-1) * $per_page;
              try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a180719_pt2 LIMIT $start_from, $per_page");
                $stmt->execute();
                $result = $stmt->fetchAll();
              }
              catch(PDOException $e){
                echo "Error: " . $e->getMessage();
              }
              foreach($result as $readrow) {
                ?>
                <tr>
                  <td><?php echo $readrow['fld_staffID']; ?></td>
                  <td><?php echo $readrow['fld_staffName']; ?></td>
                  <td><?php echo $readrow['fld_staffPhoneNumber']; ?></td>
                  <td><?php echo $readrow['fld_staffEmail']; ?></td>
                  <td><?php echo $readrow['fld_staffPassword']; ?></td>
                  <td><?php echo $readrow['fld_staffPosition']; ?></td>
                  <td>
                    <a href="staffs.php?edit=<?php echo $readrow['fld_staffID']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
                    <?php if($_SESSION['userLoginPosition']['fld_staffPosition'] == 'Admin') { ?>
                    <a href="staffs.php?delete=<?php echo $readrow['fld_staffID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
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
                  $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a180719_pt2");
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
                  <li><a href="staffs.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                  <?php
                }
                for ($i=1; $i<=$total_pages; $i++)
                  if ($i == $page)
                    echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
                  else
                    echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
                  ?>
                  <?php if ($page==$total_pages) { ?>
                    <li class="disabled"><span aria-hidden="true">»</span></li>
                  <?php } else { ?>
                    <li><a href="staffs.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
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