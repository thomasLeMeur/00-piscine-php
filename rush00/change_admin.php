<?php
session_start();
if ($_POST["submit"] === "Articles")
	$_SESSION["admin_content"] = "Articles";
else if ($_POST["submit"] === "Catégories")
	$_SESSION["admin_content"] = "Catégories";
else if ($_POST["submit"] === "Utilisateurs")
	$_SESSION["admin_content"] = "Utilisateurs";
else if ($_POST["submit"] === "Commandes")
	$_SESSION["admin_content"] = "Commandes";
header("Location: admin.php");
if ($_POST["submit"] === "Retour au menu")
{
	$_SESSION["admin_content"] = "Articles";
	$_SESSION["is_admin"] = 0;
	header("Location: index.php");
}
?>
