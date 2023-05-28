<?php
	require_once 'database.php';

	if (isset($_SESSION['isLogin'])){
    	header("LOCATION: index.php");
    }

    if (isset($_POST['userEmail'], $_POST['userPassword'])) {
    $userEmail = htmlspecialchars($_POST['userEmail']);
    $userPass = $_POST['userPassword'];

    if (empty($userEmail) || empty($userPass)) {
        $_SESSION['error'] = 'Input email and password to login';
    } else {
    	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a180719_pt2 WHERE (fld_staffEmail = :staffEmail) LIMIT 1");
        $stmt->bindParam(':staffEmail', $userEmail);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($user['fld_staffEmail'])) {
            if ($user['fld_staffPassword'] == $userPass) {
                unset($user['fld_staffPassword']);
                $_SESSION['isLogin'] = true;
                $_SESSION['userLoginPosition'] = $user;
                header("LOCATION: index.php");
                exit();
            } else {
                $_SESSION['error'] = 'Wrong password';
            }
        } else {
            $_SESSION['error'] = 'Account does not exists.';
        }
    }

    header("LOCATION: " . $_SERVER['REQUEST_URI']);
    exit();
    }
?>