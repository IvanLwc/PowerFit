<!--
Matric Number: A180719
Name: Ivan Lee Wei Chong
-->
<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['addproduct'])) {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_orders_details_a180719(fld_orderDetailID,
      fld_orderID, fld_productID, fld_orderDetailQuantity) VALUES(:orderDetailID, :orderID,
      :productID, :orderDetailQuantity)");
   
    $stmt->bindParam(':orderDetailID', $orderDetailID, PDO::PARAM_STR);
    $stmt->bindParam(':orderID', $orderID, PDO::PARAM_STR);
    $stmt->bindParam(':productID', $productID, PDO::PARAM_STR);
    $stmt->bindParam(':orderDetailQuantity', $orderDetailQuantity, PDO::PARAM_INT);
       
    $orderDetailID = uniqid('D', true);
    $orderID = $_POST['orderID'];
    $productID = $_POST['productID'];
    $orderDetailQuantity= $_POST['orderDetailQuantity'];
     
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
  $_GET['orderID'] = $orderID;
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_orders_details_a180719 where fld_orderDetailID = :orderDetailID");
   
    $stmt->bindParam(':orderDetailID', $orderDetailID, PDO::PARAM_STR);
       
    $orderDetailID = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: orders_details.php?orderID=".$_GET['orderID']);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
?>