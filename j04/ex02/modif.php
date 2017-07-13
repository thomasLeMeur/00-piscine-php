<?PHP
if ($_POST["submit"] !== "OK"
	|| $_POST["login"] === NULL || $_POST["login"] === ""
	|| $_POST["oldpw"] === NULL ||$_POST["oldpw"] === ""
	|| $_POST["newpw"] === NULL ||$_POST["newpw"] === "")
	echo "ERROR\n";
else
{
	$i = -1;
	$find = 0;
	$wrong = 0;
	$all_users = unserialize(file_get_contents("../private/passwd"));
	foreach ($all_users as $user)
		if (++$i !== NULL && $user["login"] === $_POST["login"])
		{
			if ($user["passwd"] === hash("whirlpool", $_POST["oldpw"]))
			{
				$user["passwd"] = hash("whirlpool", $_POST["newpw"]);
				$all_users_tmp = $all_users;
				$all_users_tmp[$i] = $user;
				file_put_contents("../private/passwd", serialize($all_users_tmp)."\n");
				echo "OK\n";
				exit;
			}
			break;
		}
	echo "ERROR\n";
}
?>
