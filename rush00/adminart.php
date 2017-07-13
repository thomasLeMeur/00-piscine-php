<?PHP
session_start();
function check_cats()
{
	$cats = unserialize(file_get_contents("./datas/categories"));
	$news = explode(";", $_POST["cats"]);
	foreach($news as $new)
		if ($new !== "")
		{
			$wrong = 1;
			foreach ($cats as $cat)
				if ($new === $cat)
					$wrong = 0;
			if ($wrong === 1)
				return (FALSE);
		}
	return (TRUE);
}

if ($_POST["nom"] === NULL || $_POST["nom"] === ""
	|| $_POST["prix"] === NULL || $_POST["prix"] === ""
	|| preg_match("#^[+-]?[0-9]*\.?[0-9]*$#", trim($_POST["prix"], "€")) === FALSE
	|| $_POST["cats"] === NULL || check_cats() === FALSE
	|| $_POST["img"] === NULL || $_POST["img"] === ""
	|| $_POST["desc"] === NULL || $_POST["desc"] === "")
{
	header("Location: admin.php");
	exit();
}
$i = 0;
$arts = unserialize(file_get_contents("./datas/articles"));
if (isset($arts))
{
	if ($_POST["submit"] === "Ajouter")
	{
		foreach ($arts as $art)
			if ($art["ref"] === $_POST["ref"])
			{
				header("Location: admin.php");
				exit();
			}
		$art["nom"] = $_POST["nom"];
		$art["prix"] = trim($_POST["prix"], "€");
		$art["cats"] = explode(";", $_POST["cats"]);
		$art["ref"] = $_POST["ref"];
		$art["img"] = $_POST["img"];
		$art["desc"] = $_POST["desc"];
		array_push($arts, $art);
		file_put_contents("./datas/articles", serialize($arts));
	}
	else
	{
		foreach ($arts as &$art)
			if (++$i && isset($_POST[$art["ref"]]))
			{
				if ($_POST[$art["ref"]] === "supprimer")
				{
					unset($arts[array_search($art, $arts)]);
					file_put_contents("./datas/articles", serialize($arts));
				}
				else if ($_POST[$art["ref"]] === "modifier")
				{
					$art["nom"] = $_POST["nom"];
					$art["prix"] = trim($_POST["prix"], "€");
					$art["cats"] = explode(";", $_POST["cats"]);
					$art["img"] = $_POST["img"];
					$art["desc"] = $_POST["desc"];
					file_put_contents("./datas/articles", serialize($arts));
				}
				break;
			}
	}
}
header("Location: admin.php");
?>
