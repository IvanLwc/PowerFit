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
 
    $stmt = $conn->prepare("INSERT INTO tbl_orders_a180719(fld_orderID, fld_staffID,
      fld_customerID) VALUES(:orderID, :staffID, :customerID)");
   
    $stmt->bindParam(':orderID', $orderID, PDO::PARAM_STR);
    $stmt->bindParam(':staffID', $staffID, PDO::PARAM_STR);
    $stmt->bindParam(':customerID', $customerID, PDO::PARAM_STR);
       
    $orderID = uniqid('O', true);
    $staffID = $_POST['staffID'];
    $customerID = $_POST['customerID'];
     
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
 
    $stmt = $conn->prepare("UPDATE tbl_orders_a180719 SET fld_staffID = :staffID,
      fld_customerID = :customerID WHERE fld_orderID = :orderID");
   
    $stmt->bindParam(':orderID', $orderID, PDO::PARAM_STR);
    $stmt->bindParam(':staffID', $staffID, PDO::PARAM_STR);
    $stmt->bindParam(':customerID', $customerID, PDO::PARAM_STR);
       
    $orderID = $_POST['orderID'];
    $staffID = $_POST['staffID'];
    $customerID = $_POST['customerID'];
     
    $stmt->execute();
 
    header("Location: orders.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_orders_a180719 WHERE fld_orderID = :orderID");
   
    $stmt->bindParam(':orderID', $orderID, PDO::PARAM_STR);
       
    $orderID = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: orders.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
   
    try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_orders_a180719 WHERE fld_orderID = :orderID");
   
    $stmt->bindParam(':orderID', $orderID, PDO::PARAM_STR);
       
    $orderID = $_GET['edit'];
     
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