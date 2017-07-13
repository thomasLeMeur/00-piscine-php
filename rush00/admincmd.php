<?PHP
session_start();
$i = 0;
$cmds = unserialize(file_get_contents("./datas/commandes"));
if (isset($cmds))
	foreach ($cmds as $cmd)
		if (++$i && isset($_POST[$cmd["id"]]))
		{
			if ($_POST[$cmd["id"]] === "supprimer")
			{
				unset($cmds[array_search($cmd, $cmds)]);
				file_put_contents("./datas/commandes", serialize($cmds));
			}
			break;
		}
header("Location: admin.php");
?>
