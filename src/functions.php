<?php
date_default_timezone_set('Europe/Bratislava');
include('db.php');

function list_select($min, $max, $oznac = -1)
{
	for($i = $min; $i <= $max; $i++) {
		echo "<option value='$i'";
		if ($i == $oznac) echo ' selected';
		echo ">$i</option>\n";
	}
}

function usr_check($mysqli, $username, $pass)
{
	if (!$mysqli->connect_errno) {
		$sql = "SELECT * FROM diamond_users WHERE username='$username' AND heslo=MD5('" . $pass . "')";
		if (($result = $mysqli->query($sql)) && ($result->num_rows > 0)) {
			$row = $result->fetch_assoc();
			$result->free();
			return $row;
		} else {
			return false;
		}
	} else {
		echo "<p class='error'>Unable to connect to the server!</p>";
		return false;
	}
}

function list_prod($mysqli, $admin, $uspor)
{
	if (!$mysqli->connect_errno) {
		$sql = "SELECT * FROM diamond_products";
		switch ($uspor)
		{
			case -1:
				$sql .= " ORDER BY nazov ASC";
				break;
			case 0:
				$sql .= " ORDER BY nazov ASC";
				break;
			case 1:
				$sql .= " ORDER BY nazov DESC";
				break;
			case 2:
				$sql .= " ORDER BY id_kat ASC, nazov ASC";
				break;
			case 3:
				$sql .= " ORDER BY cena ASC";
				break;
			case 4:
				$sql .= " ORDER BY cena DESC";
				break;
		}
		if (($result = $mysqli->query($sql)) && ($result->num_rows > 0)) {
			while($row = $result->fetch_assoc())
			{
				echo "<figure>";
				echo "<figcaption>" . $row['nazov'] . "</figcaption>";
				echo "<img src='src/prod-img\\" . $row["kod"] . ".png' alt='" . $row['nazov'] ."' width='130' height='130'>";
				echo "<p>Price: " . $row["cena"] . " &euro;</p>";
				if (!$admin) echo "<form method='post'><input type='submit' name=" . $row["kod"] . " value='Buy'></form>";
				echo "</figure>";
			}
			$result->free();
		} else {
			return false;
		}
	} else {
		echo "<p class='error'>Unable to connect to the server!</p>";
		return false;
	}
}


function list_cart($mysqli)
{
	if (isset($_SESSION["kos"]) && !empty($_SESSION["kos"]))
	{
		if (!$mysqli->connect_errno) {
			$count = 1;
			foreach ($_SESSION["kos"] as $prod)
			{

				$sql = "SELECT * FROM diamond_products WHERE kod=$prod";
				if (($result = $mysqli->query($sql)) && ($result->num_rows > 0)) {
					while($row = $result->fetch_assoc())
					{
						echo "<img src='src/prod-img\\" . $row["kod"] . ".png' alt='" . $row['nazov'] ."' width='130' height='130'>";
						echo "<p>$count. " . $row['nazov'] . ": " . $row["cena"] . " &euro;</p>";
					}
					$result->free();
				} else {
					return false;
				}

			$count++;
			}
			echo "<form method='post'><p><input type='submit' name='zrus' value='Remove Contents'></p></form>";
			echo "<form method='post'><p><input type='submit' name='odosli' value='Send Order'></p></form>";
		} else {
			echo "<p class='error'>Unable to connect to the server!</p>";
			return false;
		}
	}
	else
	{
		echo "<p>Your cart is empty!</p>";
	}
}

function del_cart()
{
	unset($_SESSION["kos"]);
}

function send_order($mysqli)
{
	if (!$mysqli->connect_errno) {
		$sql = "INSERT INTO diamond_orders (uid, tovar, datum, vybavena) VALUES (" . $_SESSION["uid"] . ", '" . implode(';', $_SESSION['kos']) ."', NOW(), 0)";
		if ($result = $mysqli->query($sql)) {
			echo "<p class='ok'>Your order was sent!</p>";
			return True;
		} else {
			echo "<p>Your order was unable to be sent!</p>";
			return false;
		}
	} else {
		echo "<p class='error'>Unable to connect to the server!</p>";
		return false;
	}
}

function order_by()
{
	echo "<form method='post'><p>";
	echo "<label for'sort'>Order by: </label>";
	echo "<select name='sort' size='1' id='sort'>";
	echo "<option value='-1'" . ((isset($_POST['sort']) && $_POST['sort'] == -1) ? 'selected' : '') . ">-</option>\n";
	echo "<option value='0'" . ((isset($_POST['sort']) && $_POST['sort'] == 0) ? 'selected' : '') . ">Name (A-Z)</option>\n";
	echo "<option value='1'" . ((isset($_POST['sort']) && $_POST['sort'] == 1) ? 'selected' : '') . ">Name (Z-A)</option>\n";
	echo "<option value='2'" . ((isset($_POST['sort']) && $_POST['sort'] == 2) ? 'selected' : '') . ">Category ID</option>\n";
	echo "<option value='3'" . ((isset($_POST['sort']) && $_POST['sort'] == 3) ? 'selected' : '') . ">Price (cheapest)</option>\n";
	echo "<option value='4'" . ((isset($_POST['sort']) && $_POST['sort'] == 4) ? 'selected' : '') . ">Price (most expensive)</option>\n";
	echo "</select> ";
	echo "<input type='submit' name='uspor' value='Order'>";
	echo "</p></form>";
}


function amount_of($arr)
{
	$count = 0;
	foreach ($arr as $w)
	{
		$count++;
	}
	return $count;
}

function list_orders_admin($mysqli)
{
	echo "<h2>Orders awaiting completion:</h2>";
	if (!$mysqli->connect_errno) {
		$sql = "SELECT * FROM diamond_orders, diamond_users WHERE diamond_orders.vybavena=0 AND diamond_orders.uid=diamond_users.uid";
		if (($result = $mysqli->query($sql)) && ($result->num_rows > 0)) {
			echo "<form method='post'><p>";
			while($row = $result->fetch_assoc())
			{
				$str = $row['tovar'];
				$arr = explode(';', $str);
				echo "<input type='checkbox' name='obj[]' value='" . $row['id'] . "' id='obj" . $row['id'] ."'>";
				echo "<label for='obj" . $row['id'] ."'><strong>" . $row['meno'] . " " . $row['priezvisko'] . "</strong>, amount of prod.: " . amount_of($arr) . " (" . $row['datum'] . ")</label><br>";
			}
			echo "<input type='submit' name='vybav' value='Complete Selected'>";
			echo "</p></form>";
			$result->free();
		} else {
			echo "<p class='error'>No orders to be fulfilled.</p>";
			return false;
		}
	} else {
		echo "<p class='error'>Unable to connect to the server!</p>";
		return false;
	}
}

function complete_orders($mysqli, $arr)
{
	if (!$mysqli->connect_errno) {
		$count = 1;
		foreach ($arr as $id)
		{
			$sql = "UPDATE diamond_orders SET vybavena=1 WHERE id=$id";

			if (!($result = $mysqli->query($sql))) {
				return false;
			}
			$count++;
		}
		echo "<p class='ok'>Completed the selected orders!</p>";
	} else {
		echo "<p class='error'>Unable to connect to the server!</p>";
		return false;
	}

}

?>
