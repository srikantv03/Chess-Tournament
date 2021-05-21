<?php
session_start();

$round = $_POST["winner-round"];
$game = $_POST["game-index"];
$chosen_winner = $_POST["chosen-winner"];

$round_link = $_POST["round-link"];
$game_link = $_POST["game-link"];
$full_link = $_POST["full-link"];




if($round != "" && $round != null && $game != "" && $game != null && $chosen_winner != "" && $chosen_winner != null) {
	setWinner($round, intval($game), $chosen_winner);
}

if($round_link != "" && $round_link != null && $game_link != "" && $game_link != null && $full_link != "" && $full_link != null) {
	setLinks($round_link, $game_link, $full_link);
}




function setWinner($round, $index, $winner) {
	$data_read = fopen('data/winners.json', 'r');
	$json_arr = json_decode(fread($data_read, filesize('data/winners.json')), true);

	if($json_arr[$round] != null) {
		$json_arr[$round][$index] = $winner;
	}

	$data = fopen('data/winners.json', 'w');

	fwrite($data, json_encode($json_arr));
	fclose($data);
}

function setLinks($round, $game, $link) {
	$data_read = fopen('data/links.json', 'r');
	$json_arr = json_decode(fread($data_read, filesize('data/links.json')), true);
	$edited = false;
	for($i = 0; $i < count($json_arr["links"]); $i++) {
		if($json_arr["links"][$i][0] == strval($round) && $json_arr["links"][$i][1] == strval($game)) {
			$json_arr["links"][$i][2] = $link;
			$edited = true;
		}
	}
	if(!$edited) {
		$json_arr["links"][] = array($round, $game, $link);
	}

	$data = fopen('data/links.json', 'w');

	fwrite($data, json_encode($json_arr));
	fclose($data);

}


if(!$_SESSION['admin']) {
	echo '<script type="text/javascript">';
    echo 'window.location.href="./login.php"';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url=./login.php" />';
    echo '</noscript>';
}
else if($_SESSION['admin'] == true) {

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
		<div class="row m-0">
		<div class="col-lg-12 p-3">
		<div class="card shadow p-3">
		<h5 class="card-header">Claim Winner</h5>
		<div class="card-body">
		<form class="text-center" method="post" action="admin.php"> 
			<label> Game </label>
			<select class="form-control" name="winner-round" aria-label="Default select example">
			  <option selected>Choose Game</option>
			  <option value="round1">One</option>
			  <option value="round2">Two</option>
			  <option value="round3">Three</option>
			  <option value="round4">Two</option>
			  <option value="round5">Three</option>
			</select>
			<input class="form-control" type="submit">
		</form>

<?php
	
		if($round != null && $round != "") {

?>

			<form method="post" action="admin.php"> 
			<input type="hidden" value="<?php echo $round?>" name="winner-round">
			<select class="form-control" name="game-index" aria-label="Default select example">

<?php
			$data = fopen('data/winners.json', 'r');

			$json_arr = json_decode(fread($data, filesize('data/winners.json')), true);
			$games = $json_arr[$round];

			for($i = 0; $i < count($games); $i++) {
?>
				<option value="<?php echo $i ?>"><?php echo ($i + 1) ?></option>
<?php
			}
?>
			</select>
			<input class="form-control" type="submit">

			</form>
<?php
		}

		if($round != null && $round != "" && $game != null && $game != "") {
?>
			<form method="post" action="admin.php">

			<input type="hidden" value="<?php echo $round?>" name="winner-round">
			<input type="hidden" value="<?php echo $game?>" name="game-index">
			<label> Winner </label>
			<select class="form-control" name="chosen-winner" aria-label="Default select example">

<?php
			$data = fopen('data/games.json', 'r');

			$json_arr = json_decode(fread($data, filesize('data/games.json')), true);
			$games = $json_arr["first-games"][intval($game)];

?>
			<option value="<?php echo $games[0]?>"><?php echo $games[0]?></option>
			<option value="<?php echo $games[1]?>"><?php echo $games[1]?></option>


			</select>
			<input class="form-control" type="submit">
			</form>

<?php

		}
}
?>
	</div>
	</div>
	</div>
	</div>

	<div class="row m-0">
		<div class="col-lg-12">
		<div class="card p-3 shadow">
		 <h5 class="card-header text-center">Add Links</h5>
		 <form method="post" action="admin.php">
		 <input type="text" name="round-link" class="form-control" placeholder="Round">
		 <input type="text" name="game-link" class="form-control" placeholder="Game">
		 <input type="text" name="full-link" class="form-control" placeholder="Full Link">
		 <input type="submit" class="form-control">
		 </form>

		</div>
		</div>
		</div>


	</div>

	</body>
</html>