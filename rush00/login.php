<?PHP
include("functions.php");

session_start();
if ($_POST["submit"] === NULL
	|| $_POST["login"] === NULL || $_POST["login"] === ""
	|| $_POST["passwd"] === NULL ||$_POST["passwd"] === "")
	header("Location: logs.php");
if ($_POST["submit"] === "Connexion")
{
	if (auth($_POST["login"], $_POST["passwd"], "./datas/passwd") === TRUE)
	{
		$_SESSION["loggued_on_user"] = $_POST["login"];
		header("Location: index.php");
	}
	else
	{
		$_SESSION["loggued_on_user"] = "";
		header("Location: logs.php");
	}
}
else if ($_POST["submit"] === "Administration")
{
	if (auth($_POST["login"], $_POST["passwd"], "./datas/admins") === TRUE)
	{
		$_SESSION["is_admin"] = 1;
		header("Location: admin.php");
	}
	else
		header("Location: logs.php");
}
else
	header("Location: logs.php");
?>
