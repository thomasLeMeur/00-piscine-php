<?PHP
session_start();
$i = 0;
$users = unserialize(file_get_contents("./datas/passwd"));
if (isset($users))
	foreach ($users as $user)
		if (++$i && isset($_POST[$user["login"]]))
		{
			if ($_POST[$user["login"]] === "supprimer")
			{
				unset($users[array_search($user, $users)]);
				file_put_contents("./datas/passwd", serialize($users));
			}
			else if ($_POST[$user["login"]] === "promouvoir")
			{
				$adms = unserialize(file_get_contents("./datas/admins"));
				if (array_search($user, $adms) === FALSE)
					array_push($adms, $user);
				file_put_contents("./datas/admins", serialize($adms));
			}
			break;
		}
header("Location: admin.php");
?>
