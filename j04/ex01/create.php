<?PHP
if ($_POST["submit"] !== "OK"
	|| $_POST["login"] === NULL || $_POST["login"] === ""
	|| $_POST["passwd"] === NULL ||$_POST["passwd"] === "")
	echo "ERROR\n";
else
{
	$error = 0;
	if (file_exists("../private/passwd") === TRUE)
	{
		$find = 0;
		$all_users = unserialize(file_get_contents("../private/passwd"));
		foreach ($all_users as $user)
			if ($user["login"] === $_POST["login"])
				$error = 1;
	}
	else
		$all_users = array();
	if ($error == 0)
	{
		if (file_exists("../private") === FALSE)
			mkdir("../private", 0700);
		$user = array();
		$user["login"] = $_POST["login"];
		$user["passwd"] = hash("whirlpool", $_POST["passwd"]);
		$i = 0;
		while ($all_users[$i] !== NULL)
			$i++;
		$all_users[$i] = $user;
		file_put_contents("../private/passwd", serialize($all_users)."\n");
		echo "OK\n";
	}
	else
		echo "ERROR\n";
}
?>
