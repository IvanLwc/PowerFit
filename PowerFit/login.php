<!--
Matric Number: A180719
Name: Ivan Lee Wei Chong
-->
<?php
  include_once 'login_crud.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>PowerFit Body Building Equipment and Supplement Shop</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/login.css" rel="stylesheet">  
</head>
<body>
  <div class="bg">
  <img id="logo" src="PowerFitLogo.png" class="main-logo">
          <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" class="login"> 
            <h1><?php 
            if (isset($_SESSION['error'])){
              echo "<script>Swal.fire({title:\"Error\",html:\"".$_SESSION['error']."\",confirmButtonText: \"Got it\",});</script>";
                    unset($_SESSION['error']);
                  }
             ?> </h1>

            <h1>Welcome to PowerFit!</h1>
            <input type="email" name="userEmail" placeholder="Email" />
            <input type="password" name="userPassword" placeholder="Password" />

            <button type="submit" name="login" id="login" value="Login" class="buttons">Login</button>
            <button type="button" name="acc" class="buttons" onclick="return showAccount();">Account</button>
        </form>   
  </div>
  
</body>

<script>
  function showAccount(){
    Swal.fire({
          title: "<strong>Example Accounts</strong>", 
          html: "<h1>Admin</h1><hr>ivan@gmail.com<br>Ivan123<br><h1>Supervisor</h1><hr>sam@gmail.com<br>Sam123<br><h1>Staff</h1><hr>mary@gmail.com<br>Mary123<br>",
          confirmButtonText: "Ok", 
        });
  }
</script>
</html>