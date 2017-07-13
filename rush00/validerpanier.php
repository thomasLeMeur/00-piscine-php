<?PHP
include("cookie_infos.php");

session_start();
if ($_POST["valider"] !== "Valider" || !isset($_COOKIE["panier"]))
	header("Location: panier.php");
else if	($_SESSION["loggued_on_user"] === "")
	header("Location: logs.php");
else
{
	$arts = unserialize($_COOKIE["panier"]);
	if (!isset($arts) || count($arts) === 0)
		header("Location: panier.php");
	else
	{
		header("Location: index.php");
		$arts = get_cookie_infos();
		$cmds = unserialize(file_get_contents("./datas/commandes"));
		setcookie("panier", serialize(array()), time());
		$i = 0;
		$total = 0;
		foreach ($cmds as $cmd)
			$i = $cmd["id"] + 1;
		foreach ($arts as $art)
			$total += $art["nb"] * $art["prix"];
		date_default_timezone_set("Europe/Paris");
		$cmd["user"] = $_SESSION["loggued_on_user"];
		$cmd["date"] = date("d/m/y H:i:s");
		$cmd["prix"] = $total;
		$cmd["id"] = $i;
		array_push($cmds, $cmd);
		file_put_contents("./datas/commandes", serialize($cmds));
		print_r(get_cookie_infos());
	}
}
?>
