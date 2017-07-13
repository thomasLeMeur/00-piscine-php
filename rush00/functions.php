<?PHP
function auth($login, $passwd, $file)
{
	$all_users = unserialize(file_get_contents($file));
	foreach ($all_users as $user)
		if ($user["login"] === $login && $user["passwd"] === hash("whirlpool", $passwd))
				return (TRUE);
	return (FALSE);
}

function add_account($login, $hash_passwd, &$accounts)
{
	$account["login"] = $login;
	$account["passwd"] = $hash_passwd;
	array_push($accounts, $account);
}

function add_article($nom, $prix, $cats, $ref, $img, $desc, &$arts)
{
	$art["nom"] = $nom;
	$art["prix"] = $prix;
	$art["cats"] = $cats;
	$art["ref"] = $ref;
	$art["img"] = $img;
	$art["desc"] = $desc;
	array_push($arts, $art);
}
?>
