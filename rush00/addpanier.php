<?PHP
session_start();
if ($_POST[($ref = key($_POST))] === "Ajouter au panier")
{
	$arts = unserialize(file_get_contents("./datas/articles"));
	foreach ($arts as $art)
		if ($ref === $art["ref"])
		{
			$i = 0;
			$find = 0;
			if (isset($_COOKIE["panier"]))
				$panier = unserialize($_COOKIE["panier"]);
			else
				$panier = array();
			$tmp = $panier;
			foreach ($panier as &$elem)
				if ($elem["ref"] === $ref)
				{
					$elem["value"]++;
					$find = 1;
					break;
				}
			if ($find === 0)
			{
				$add["ref"] = $ref;
				$add["value"] = 1;
				array_push($panier, $add);
			}
			setcookie("panier", serialize($panier));
			header("Location: index.php");
			exit;
		}
}
?>
