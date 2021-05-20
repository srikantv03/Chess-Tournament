<?php
session_start();

$round = $_POST["winner-round"];
$game = $_POST["game-index"];
$chosen_winner = $_POST["chosen-winner"];

if($round != "" && $round != null && $game != "" && $game != null && $chosen_winner != "" && $chosen_winner != null) {

	setWinner($round, intval($game), $chosen_winner);
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
		<form method="post" action="admin.php"> 
			<select class="form-select" name="winner-round" aria-label="Default select example">
			  <option selected>Open this select menu</option>
			  <option value="round1">One</option>
			  <option value="round2">Two</option>
			  <option value="round3">Three</option>
			  <option value="round4">Two</option>
			  <option value="round5">Three</option>
			</select>
			<input type="submit">
		</form>

<?php
	
		if($round != null && $round != "") {

?>

			<form method="post" action="admin.php"> 
			<input type="hidden" value="<?php echo $round?>" name="winner-round">
			<select class="form-select" name="game-index" aria-label="Default select example">

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
			<input type="submit">

			</form>
<?php
		}

		if($round != null && $round != "" && $game != null && $game != "") {
?>
			<form method="post" action="admin.php">
			<input type="hidden" value="<?php echo $round?>" name="winner-round">
			<input type="hidden" value="<?php echo $game?>" name="game-index">

			<select class="form-select" name="chosen-winner" aria-label="Default select example">

<?php
			$data = fopen('data/games.json', 'r');

			$json_arr = json_decode(fread($data, filesize('data/games.json')), true);
			$games = $json_arr["first-games"][intval($game)];

?>
			<option value="<?php echo $games[0]?>"><?php echo $games[0]?></option>
			<option value="<?php echo $games[1]?>"><?php echo $games[1]?></option>


			</select>
			<input type="submit">
			</form>

<?php

		}
}
?>


	</body>
</html>