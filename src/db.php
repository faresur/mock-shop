<?php

$mysqli = new mysqli('localhost', 'root', '', 'diamond-data');
if ($mysqli->connect_errno) {
	echo '<p class="error">Connection unsuccessful!</p>';
} else {
	$mysqli->query("SET CHARACTER SET 'utf8'");
}

?>