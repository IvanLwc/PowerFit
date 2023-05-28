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
 
    $stmt = $conn->prepare("INSERT INTO tbl_customers_a180719_pt2(fld_customerID, fld_customerName,
      fld_customerPhoneNumber, fld_customerAddress) VALUES(:customerID, :customerName, :customerPhoneNumber,
      :customerAddress)");
   
    $stmt->bindParam(':customerID', $customerID, PDO::PARAM_STR);
    $stmt->bindParam(':customerName', $customerName, PDO::PARAM_STR);
    $stmt->bindParam(':customerPhoneNumber', $customerPhoneNumber, PDO::PARAM_STR);
    $stmt->bindParam(':customerAddress', $customerAddress, PDO::PARAM_STR);
       
    $customerID = $_POST['customerID'];
    $customerName = $_POST['customerName'];
    $customerPhoneNumber = $_POST['customerPhoneNumber'];
    $customerAddress =  $_POST['customerAddress'];
       
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
 
    $stmt = $conn->prepare("UPDATE tbl_customers_a180719_pt2 SET fld_customerID = :customerID,
      fld_customerName = :customerName, fld_customerPhoneNumber = :customerPhoneNumber,
      fld_customerAddress = :customerAddress WHERE fld_customerID = :customerOldID");
   
    $stmt->bindParam(':customerID', $customerID, PDO::PARAM_STR);
    $stmt->bindParam(':customerName', $customerName, PDO::PARAM_STR);
    $stmt->bindParam(':customerPhoneNumber', $customerPhoneNumber, PDO::PARAM_STR);
    $stmt->bindParam(':customerAddress', $customerAddress, PDO::PARAM_STR);
    $stmt->bindParam(':customerOldID', $customerOldID, PDO::PARAM_STR);
       
    $customerID = $_POST['customerID'];
    $customerName = $_POST['customerName'];
    $customerPhoneNumber = $_POST['customerPhoneNumber'];
    $customerAddress =  $_POST['customerAddress'];
    $customerOldID = $_POST['customerOldID'];
       
    $stmt->execute();
 
    header("Location: customers.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_customers_a180719_pt2 WHERE fld_customerID = :customerID");
   
    $stmt->bindParam(':customerID', $customerID, PDO::PARAM_STR);
       
    $customerID = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: customers.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_customers_a180719_pt2 WHERE fld_customerID = :customerID");
   
    $stmt->bindParam(':customerID', $customerID, PDO::PARAM_STR);
       
    $customerID = $_GET['edit'];
     
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