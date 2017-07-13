<?php
session_start();
if ($_POST["submit"] === "Charger")
{
	if (isset($_POST["cats"]))
		$_SESSION["cats"] = $_POST["cats"];
	else
		$_SESSION["cats"] = array();
}
header("Location: index.php");
?>
