<?php 

// the following is sample data generation code
// will not be used in the real event, just used to test the display and edit features

//  $myfile = fopen("data/winners.json", "w");

// $arr = array("round1" => array_fill(0, 16, null),
// 	"round2" => array_fill(0, 8, null),
//  	"round3" => array_fill(0, 4, null),
//  	"round4" => array_fill(0, 2, null),
//  	"round5" => array_fill(0, 1, null));

//  fwrite($myfile, json_encode($arr));
//  fclose($myfile);
// $myfile = fopen("data/games.json", "w");
// $names = fopen("data/names.json", "w");

// if($myfile != false) {
// 	$arrs = array();

// 	for($i = 0; $i < 32; $i += 1) {
// 		$arrs[] = strval($i);
// 	}



// 	$r = new randomNameGenerator('array');

// 	fwrite($names, json_encode($r->generateNames(32)));
// 	fclose($names);

// 	$mix = $arrs;
// 	shuffle($mix);


// 	$set1 = array_chunk($mix, 2);



	

// 	$json = array("first-games" => $set1);



// 	fwrite($myfile, json_encode($json));
// 	fclose($myfile);
// }



?>


<html>
	<head>
		<meta charset="utf-8" />
		<meta name="description" content="" />
        <meta name="author" content="" />
        <title>Apex Friendship Chess Tournament</title>
        <link rel="icon" type="image/x-icon" href="icons/favicon.png" />

        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</head>
	<body>
		<nav class="navbar navbar-light bg-light justify-content-between">
		  <a class="navbar-brand">Chess Tournament</a>
		  <form class="form-inline">
		    <a href="./admin.php" class="nav-link">Admin Login</a>
		  </form>
		</nav>
		<div class="row m-0" style="padding: 10px">
			<div class="col-lg-12">
				<div class="card bg-light shadow p-3">
					<h5 class="card-header text-center"> 
						<button type="button" class="btn" data-toggle="collapse" data-target="#pchart" aria-expanded="false" aria-controls="pchart"> Player Chart </button>
					</h5>
					<div class="collapse" id="pchart">
					<div class="card-body">
						<table class="table">
						<thead>
						   <tr>
						    <th scope="col">Player #</th>
						    <th scope="col">Name</th>
						   </tr>
						 </thead>
						 <tbody>

<?php

$player_data = fopen('data/names.json', 'r');


$pdata_string = json_decode(fread($player_data, filesize("data/names.json")), true);

for($i = 0; $i < count($pdata_string); $i++){
?>	
						<tr>
							<th> <?php echo $i ?></th>
							<th> <?php echo $pdata_string[$i] ?></th>
						</tr>
<?php
}

?>
						</tbody>
						</table>

					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row m-0" style="padding: 10px">
			<div class="col-lg-12">
				<div class="card bg-light shadow p-3">
					<h5 class="card-header text-center">
					<button type="button" class="btn" data-toggle="collapse" data-target="#gchart" aria-expanded="false" aria-controls="gchart"> Games </button>
					</h5>
					<div class="collapse" id="gchart">
					<div class="card-body">
						<table class="table">
						<thead>
						   <tr>
						    <th scope="col">Round #</th>
						    <th scope="col">Game #</th>
						    <th scope="col">Player 1</th>
						    <th scope="col">Player 2</th>
						    <th scope="col">Status</th>
						    <th scope="col">Time</th>
						   </tr>
						 </thead>
						 <tbody>
<?php

$data = fopen('data/games.json', 'r');

$data_string = json_decode(fread($data, filesize("data/games.json")), true);
$winners = json_decode(fread(fopen('data/winners.json', 'r'), filesize('data/winners.json')), true);


for($i = 0; $i < count($data_string["first-games"]); $i++){
?>	

						<tr>
							<th> <?php echo "1" ?> </th>
							<th> <?php echo strval($i + 1) ?> </th>

<?php
	if($winners["round1"][$i] == null) {
?>

							<th> <?php echo $data_string["first-games"][$i][0] ?> - <?php echo $pdata_string[intval($data_string["first-games"][$i][0])] ?> </th>
							<th> <?php echo $data_string["first-games"][$i][1] ?> - <?php echo $pdata_string[intval($data_string["first-games"][$i][1])] ?></th>
							<th> Unfinished </th>
						
<?php
	}
	else {
		$color1 = "";
		$color2 = "";
		if($winners["round1"][$i] == $data_string["first-games"][$i][0]) {
			$color1 = "green";
			$color2 = "red";
		}
		elseif($winners["round1"][$i] == $data_string["first-games"][$i][1]) {
			$color1 = "red";
			$color2 = "green";
		}

?>

						<th style="color: <?php echo $color1 ?>"> <?php echo $data_string["first-games"][$i][0] ?> - <?php echo $pdata_string[intval($data_string["first-games"][$i][0])] ?> </th>
						<th style="color: <?php echo $color2 ?>"> <?php echo $data_string["first-games"][$i][1] ?> - <?php echo $pdata_string[intval($data_string["first-games"][$i][1])] ?></th>
						<th> Finished </th>
						
<?php
	}

?>
						<th> 10:00 </th>
						</tr>
<?php

}

?>

			</tbody>
			</table>
			</div>
			</div>
		</div>
		</div>
		</div>

		<div class="row m-0" style="padding: 10px">
			<div class="col-lg-12">
				<div class="card bg-light shadow p-3">
					<h5 class="card-header text-center">
					<button type="button" class="btn" data-toggle="collapse" data-target="#lchart" aria-expanded="false" aria-controls="gchart"> LiChess Links </button>
					</h5>
					<div class="collapse" id="lchart">
					<div class="card-body">
						<table class="table">
						<thead>
							<tr>
							<th scope="col">Round #</th>
							<th scope="col">Game #</th>
							<th scope="col">LiChess Link</th>
							</tr>
						</thead>
						<tbody>

<?php
$data = fopen('data/links.json', 'r');

$data_string = json_decode(fread($data, filesize("data/links.json")), true)["links"];

for($i = 0; $i < count($data_string); $i++) {

?>		
						<tr>
						<th><?php echo $data_string[$i][0] ?></th>
						<th><?php echo $data_string[$i][1] ?></th>
						<th><a target="_blank" href="<?php echo $data_string[$i][2] ?>">Link</a></th>
						</tr>
<?php

}

?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
 
	</body>
</html>