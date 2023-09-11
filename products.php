<?php
session_start();

$pg_title = 'Products';
include('functions.php');
include('header.php');
?>
<section>   

<?php

if (!$mysqli->connect_errno) {
	$sql = "SELECT * FROM diamond_products";
	if (($result = $mysqli->query($sql)) && ($result->num_rows > 0)) {
		while($row = $result->fetch_assoc())
		{
			if (isset($_POST[$row["kod"]]))
			{
				if (isset($_SESSION["kos"])) {
					array_push($_SESSION["kos"], $row["kod"]);
					echo "<p>Product number " . $row["kod"] . " was added to your cart.</p>";
				}
				else 
				{
					$_SESSION["kos"] = array($row["kod"]);
				}
			}
		}
		$result->free();
	} else {
		return false;
	}
} else {
	return false;
}

order_by();
list_prod($mysqli, isset($_SESSION["admin"]) ? $_SESSION["admin"] : 1, isset($_POST["uspor"]) ? $_POST["sort"] : -1);

?>

</section> 
<?php include('foot.php'); ?>
