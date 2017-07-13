<?PHP
session_start();
if ($_POST["submit"] !== "Créer un compte"
	|| $_POST["login"] === NULL || $_POST["login"] === ""
	|| $_POST["passwd"] === NULL ||$_POST["passwd"] === "")
	header("Location: logs.php");
else
{
	$users = unserialize(file_get_contents("./datas/passwd"));
	foreach ($users as $user)
		if ($user["login"] === $_POST["login"] && $user["passwd"] === hash('whirlpool', $_POST["passwd"]))
		{
			header("Location: logs.php");
			exit;
		}
	$user = array();
	$user["login"] = $_POST["login"];
	$user["passwd"] = hash("whirlpool", $_POST["passwd"]);
	array_push($users, $user);
	file_put_contents("./datas/passwd", serialize($users)."\n");
	$_SESSION["loggued_on_user"] = $_POST["login"];
	header("Location: index.php");
}
?>
