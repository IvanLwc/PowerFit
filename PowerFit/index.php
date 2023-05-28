<!--
Matric Number: A180719
Name: Ivan Lee Wei Chong
-->

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
	<title>PowerFit Body Building Equipment and Supplement Shop</title> 
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">  
    <link href="css/index.css" rel="stylesheet">  
</head>
<body>
	<?php include_once 'nav_bar.php'; ?>
  <div class="bg">
    <div>
      <img id="logo" src="PowerFitLogo.png" class="main-logo" style="margin-top:0px; width: 500px;height: 500px;">
    </div>
  </div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>