<?php 
$myfile = fopen("data/players.json", "w");

if(!$myfile) {
	echo "L bruh";
}
else {
	$arrs = array();

	for($i = 0; $i < 32; $i += 1) {
		$arrs[] = strval($i);
	}

	$json = array("data" => $arrs);



	fwrite($myfile, json_encode($json));
	fclose($myfile);
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
		<nav class="navbar navbar-light bg-light justify-content-between">
		  <a class="navbar-brand">Chess Tournament</a>
		  <form class="form-inline">
		    <a class="nav-link">Admin Login</a>
		  </form>
		</nav>
		<div class="row">
			<div class="col-12-lg">
				<div class="card bg-light shadow p-3">
					<h5 class="card-header">
						Player Chart
					</h5>
					<div class="card-body">

<?php

$player_data = fopen('data/players.json', 'r');

$data_string = json_decode(fread($player_data, filesize("data/players.json")));

echo $data_string;


foreach($data_string["data"] as $player){
	echo $player;
}

?>

					</div>
				</div>
			</div>
		</div>

	</body>
</html>