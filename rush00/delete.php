<?php
session_start();
foreach($_POST as $key => $value)
{
	$i = 0;
	$panier = unserialize($_COOKIE["panier"]);
	foreach ($panier as &$elem)
		if (++$i && $elem["ref"] === $key)
			if ($_POST[$key] === "Supprimer")
			{
				unset($panier[array_search($elem, $panier)]);
				setcookie("panier", serialize($panier));
				break;
			}
}
header("Location: panier.php");
?>
