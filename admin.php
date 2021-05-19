<?php
session_start();

if(!$_SESSION['admin']) {
	echo '<script type="text/javascript">';
    echo 'window.location.href="./login.php"';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url=./login.php" />';
    echo '</noscript>';
}
else if($_SESSION['admin'] == True) {
?>



<p> You're an admin </p>


<?php
}
?>

