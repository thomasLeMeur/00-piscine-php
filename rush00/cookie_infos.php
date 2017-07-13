<?php
session_start();
function get_cookie_infos()
{
	if (!isset($_COOKIE["panier"]))
		return(array());
	$panier = unserialize($_COOKIE["panier"]);
	$prods = unserialize(file_get_contents("./datas/articles"));
	$arts = array();
	foreach ($panier as $elem)
		foreach ($prods as $prod)
			if ($prod["ref"] === $elem["ref"])
			{
				$art["nom"] = $prod["nom"];
				$art["ref"] = $elem["ref"];
				$art["prix"] = $prod["prix"];
				$art["nb"] = $elem["value"];
				array_push($arts, $art);
				break;
			}
	return ($arts);
}
?>
