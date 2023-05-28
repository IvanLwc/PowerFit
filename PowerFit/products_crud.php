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
 
      $stmt = $conn->prepare("INSERT INTO tbl_products_a180719_pt2(fld_productID,
        fld_productName, fld_productPrice, fld_productBrand, fld_productCategory,
        fld_productRating, fld_productStock) VALUES(:productID, :productName, :productPrice, :productBrand,
        :productCategory, :productRating, :productStock)");
     
      $stmt->bindParam(':productID', $productID, PDO::PARAM_STR);
      $stmt->bindParam(':productName', $productName, PDO::PARAM_STR);
      $stmt->bindParam(':productPrice', $productPrice, PDO::PARAM_INT);
      $stmt->bindParam(':productBrand', $productBrand, PDO::PARAM_STR);
      $stmt->bindParam(':productCategory', $productCategory, PDO::PARAM_STR);
      $stmt->bindParam(':productRating', $productRating, PDO::PARAM_INT);
      $stmt->bindParam(':productStock', $productStock, PDO::PARAM_INT);
       
    $productID = $_POST['productID'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productBrand =  $_POST['productBrand'];
    $productCategory = $_POST['productCategory'];
    $productRating = $_POST['productRating'];
    $productStock = $_POST['productStock'];
     
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
 
      $stmt = $conn->prepare("UPDATE tbl_products_a180719_pt2 SET fld_productID = :productID,
        fld_productName = :productName, fld_productPrice = :productPrice, fld_productBrand = :productBrand,
        fld_productCategory = :productCategory, fld_productRating = :productRating, fld_productStock = :productStock
        WHERE fld_productID = :productOldID");
     
      $stmt->bindParam(':productID', $productID, PDO::PARAM_STR);
      $stmt->bindParam(':productName', $productName, PDO::PARAM_STR);
      $stmt->bindParam(':productPrice', $productPrice, PDO::PARAM_INT);
      $stmt->bindParam(':productBrand', $productBrand, PDO::PARAM_STR);
      $stmt->bindParam(':productCategory', $productCategory, PDO::PARAM_STR);
      $stmt->bindParam(':productRating', $productRating, PDO::PARAM_INT);
      $stmt->bindParam(':productStock', $productStock, PDO::PARAM_INT);
      $stmt->bindParam(':productOldID', $productOldID, PDO::PARAM_STR);
       
    $productID = $_POST['productID'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productBrand =  $_POST['productBrand'];
    $productCategory = $_POST['productCategory'];
    $productRating = $_POST['productRating'];
    $productStock = $_POST['productStock'];
    $productOldID = $_POST['productOldID'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
      $stmt = $conn->prepare("DELETE FROM tbl_products_a180719_pt2 WHERE fld_productID = :productID");
     
      $stmt->bindParam(':productID', $productID, PDO::PARAM_STR);
       
    $productID = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
 
  try {
 
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a180719_pt2 WHERE fld_productID = :productID");
     
      $stmt->bindParam(':productID', $productID, PDO::PARAM_STR);
       
    $productID = $_GET['edit'];
     
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