<?php
session_start();

include_once 'env/login.php';

$uin = $_POST["username"];
$pin = $_POST["password"];

if($uin != null and $pin != null){
	if($uin == $adminu && $pin == $adminp) {
		$_SESSION["admin"] = True;
		 echo '<script type="text/javascript">';
         echo 'window.location.href="./admin.php"';
         echo '</script>';
         echo '<noscript>';
         echo '<meta http-equiv="refresh" content="0;url=./admin.php" />';
         echo '</noscript>';
	}
	else {
		$_SESSION["admin"] = False;
?>
		<div class="alert alert-danger" role="alert">
		  Incorrect Admin Credentials!
		</div>
<?php

	}
}

?>

<html>
	<head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Apex Friendship Chess Tournament</title>
        <link rel="icon" type="image/x-icon" href="icons/favicon.png" />
        <link href="./css/main.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

        <link href="css/styles.css" rel="stylesheet" />

        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="panel panel-default">
                    <form method="post" action="login.php">
                           <h2 style="position: center" class="login-header with-logo">ADMIN LOG IN</h2>
                            <hr />
                            <div class="card shadow p-3 bg-light" style="padding: 30px">
                                <div class="card-body">
                            <div class="form-group">
                                <label style="color: black"> Username </label>
                                <input name="username" class ="form-control" type="text"></input>
                                
                                <p class="text-danger"></p>
                            </div>
                            <div class="form-group">
                                <label style="color: black"> Password </label>
                                <input name="password" class ="form-control" type="text"></input>
                                <p class="text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input style="width: 100%" type="submit" value="Log in" class="btn btn-default login-btn" />
                            </div>
                            <br>
                        </div>
                            </div>
                    </form>

                </div>
            </div>
	</body>


</html>