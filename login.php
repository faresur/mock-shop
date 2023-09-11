<?php
session_start();
$pg_title = 'Login';

include('db.php');
include('functions.php');
include('header.php');
?>
<section>
<?php
if (isset($_POST["prihlasmeno"]) && isset($_POST["heslo"]) && $pouzivatel = usr_check($mysqli, $_POST["prihlasmeno"], $_POST["heslo"])) {
	$_SESSION['uid'] = $pouzivatel['uid'];
	$_SESSION['user'] = $pouzivatel['username'];
	$_SESSION['meno'] = $pouzivatel['meno'];
	$_SESSION['priezvisko'] = $pouzivatel['priezvisko'];
	$_SESSION['admin'] = $pouzivatel['admin'];
} elseif (isset($_POST['odhlas'])) { // bol odoslany formular s odhlasenim
	session_unset();
	session_destroy();
}

if (isset($_SESSION['user'])) {
?>
<p>Welcome, <strong><?php echo $_SESSION['meno'] . ' ' . $_SESSION['priezvisko']; ?></strong>.</p>
<?php
  if ($_SESSION['admin']) {
		echo "<p class='ok'>You have admin privileges.</p>";
		if (isset($_POST['vybav']) && isset($_POST['obj']))
		{
			complete_orders($mysqli, $_POST['obj']);
		}
		list_orders_admin($mysqli);
	}	else {
		echo "<p class='error'>You DON'T have admin privileges.</p>";
	}
?>
<form method="post"> 
  <p> 
    <input name="odhlas" type="submit" id="odhlas" value="Logout"> 
  </p> 
</form> 
<?php

}  else {
?>
	<form method="post">
		<p><label for="prihlasmeno">Username:</label> 
		<input name="prihlasmeno" type="text" size="30" maxlength="30" id="prihlasmeno" value="<?php if (isset($_POST["prihlasmeno"])) echo $_POST["prihlasmeno"]; ?>" ><br>
		<label for="heslo">Password:</label> 
		<input name="heslo" type="password" size="30" maxlength="30" id="heslo"> 
		</p>
		<p>
			<input name="submit" type="submit" id="submit" value="Login">
		</p>
	</form>
<?php
}
?>
</section>
<?php include('foot.php'); ?>
