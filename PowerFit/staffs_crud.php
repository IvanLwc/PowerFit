<!--
Matric Number: A180719
Name: Ivan Lee Wei Chong
-->
<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_staffs_a180719_pt2(fld_staffID, fld_staffName, fld_staffPhoneNumber, fld_staffEmail, fld_staffPassword, fld_staffPosition)VALUES(:staffID, :staffName, :staffPhoneNumber, :staffEmail, :staffPassword, :staffPosition)");
   
    $stmt->bindParam(':staffID', $staffID, PDO::PARAM_STR);
    $stmt->bindParam(':staffName', $staffName, PDO::PARAM_STR);
    $stmt->bindParam(':staffPhoneNumber', $staffPhoneNumber, PDO::PARAM_STR);
    $stmt->bindParam(':staffEmail', $staffEmail, PDO::PARAM_STR);
    $stmt->bindParam(':staffPassword', $staffPassword, PDO::PARAM_STR);
    $stmt->bindParam(':staffPosition', $staffPosition, PDO::PARAM_STR);

    $staffID = $_POST['staffID'];
    $staffName = $_POST['staffName'];
    $staffPhoneNumber = $_POST['staffPhoneNumber'];
    $staffEmail = $_POST['staffEmail'];
    $staffPassword = $_POST['staffPassword'];
    $staffPosition = $_POST['staffPosition'];
         
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])) {
   
  try {
 
    $stmt = $conn->prepare("UPDATE tbl_staffs_a180719_pt2 SET
      fld_staffID = :staffID, fld_staffName = :staffName,
      fld_staffPhoneNumber = :staffPhoneNumber, fld_staffEmail = :staffEmail, fld_staffPassword = :staffPassword, fld_staffPosition = :staffPosition
      WHERE fld_staffID = :staffOldID");
   
    $stmt->bindParam(':staffID', $staffID, PDO::PARAM_STR);
    $stmt->bindParam(':staffName', $staffName, PDO::PARAM_STR);
    $stmt->bindParam(':staffPhoneNumber', $staffPhoneNumber, PDO::PARAM_STR);
    $stmt->bindParam(':staffEmail', $staffEmail, PDO::PARAM_STR);
    $stmt->bindParam(':staffPassword', $staffPassword, PDO::PARAM_STR);
    $stmt->bindParam(':staffPosition', $staffPosition, PDO::PARAM_STR);
    $stmt->bindParam(':staffOldID', $staffOldID, PDO::PARAM_STR);
       
    $staffID = $_POST['staffID'];
    $staffName = $_POST['staffName'];
    $staffPhoneNumber = $_POST['staffPhoneNumber'];
    $staffEmail = $_POST['staffEmail'];
    $staffPassword = $_POST['staffPassword'];
    $staffPosition = $_POST['staffPosition'];
    $staffOldID = $_POST['staffOldID'];
         
    $stmt->execute();
 
    header("Location: staffs.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_staffs_a180719_pt2 where fld_staffID = :staffID");
   
    $stmt->bindParam(':staffID', $staffID, PDO::PARAM_STR);
       
    $staffID = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: staffs.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a180719_pt2 where fld_staffID = :staffID");
   
    $stmt->bindParam(':staffID', $staffID, PDO::PARAM_STR);
       
    $staffID = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
 
?>