<?PHP
session_start();
$i = 0;
$cats = unserialize(file_get_contents("./datas/categories"));
if (isset($cats))
{
	foreach ($cats as $cat)
		if (++$i && isset($_POST[$cat]))
		{
			if ($_POST[$cat] === "supprimer")
			{
				$arts = unserialize(file_get_contents("./datas/articles"));
				foreach ($arts as &$art)
					unset($art["cats"][array_search($cat, $art["cats"])]);
				file_put_contents("./datas/articles", serialize($arts));
				foreach ($_SESSION["cats"] as &$art)
					unset($art["cats"][array_search($cat, $_SESSION["cats"])]);
				unset($cats[array_search($cat, $cats)]);
			}
			else if ($_POST[$cat] === "ajouter" && $_POST["nom"] && array_search($_POST["nom"], $cats) === FALSE)
				array_push($cats, $_POST["nom"]);
			break;
		}
	if ($_POST["submit"] === "ajouter" && $_POST["nom"] && array_search($_POST["nom"], $cats) === FALSE)
		array_push($cats, $_POST["nom"]);
	file_put_contents("./datas/categories", serialize($cats));
}
header("Location: admin.php");
?>
