<?php
session_start();

$pg_title = 'Cart';

include('src/db.php');
include('src/functions.php');
include('src/header.php');



?>
<section>
<h2>Products in your cart:</h2>

<?php
if (isset($_SESSION["user"]) && !$_SESSION['admin'])
{
if (isset($_POST["zrus"]))
{
	del_cart();
}

if (isset($_POST["odosli"]))
{
	send_order($mysqli);
	del_cart();
}

list_cart($mysqli);
}
else
{
	 echo "<p class='error'>You DON'T have access to this section!</p>";
}
?>

</section> 
<?php include('src/foot.html'); ?>
