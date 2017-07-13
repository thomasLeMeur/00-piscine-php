#!/usr/bin/php
<?PHP

function get_moyenne()
{
	$nb = 0;
	$sum = 0;
	$tab = array();
	fgets(STDIN);
	while (($s = fgets(STDIN)))
	{
		$tmp = explode(";", $s);
		if (strcmp("moulinette", $tmp[2]) && ($tmp[1] || $tmp[1] === "0"))
		{
			$sum += $tmp[1];
			$nb++;
		}
	}
	return ($sum / $nb);
}

function get_moyenne_user()
{
	$nb = 0;
	$sum = 0;
	$tab = array();
	fgets(STDIN);
	while (($s = fgets(STDIN)))
	{
		$tmp = explode(";", $s);
		if (strcmp("moulinette", $tmp[2]) && ($tmp[1] || $tmp[1] === "0"))
		{
			$add = $tab[$tmp[0]];
			$add["sum"] += $tmp[1];
			$add["nb"]++;
			$tab[$tmp[0]] = $add;
		}
	}
	ksort($tab);
	return ($tab);
}

function get_ecart()
{
	$nb = 0;
	$sum = 0;
	$tab = array();
	fgets(STDIN);
	while (($s = fgets(STDIN)))
	{
		$tmp = explode(";", $s);
		if (strcmp("moulinette", $tmp[2]) && ($tmp[1] || $tmp[1] === "0"))
		{
			$add = $tab[$tmp[0]];
			$add["sum"] += $tmp[1];
			$add["nb"]++;
			$tab[$tmp[0]] = $add;
		}
		if (!strcmp("moulinette", $tmp[2]))
		{
			$add = $tab[$tmp[0]];
			$add["n_sum"] += $tmp[1];
			$add["n_nb"]++;
			$tab[$tmp[0]] = $add;
		}
	}
	ksort($tab);
	return ($tab);
}

if ($argc > 1)
{
	if (!strcmp("moyenne", $argv[1]))
		echo get_moyenne()."\n";
	else if (!strcmp("moyenne_user", $argv[1]))
	{
		$tab = get_moyenne_user();
		foreach ($tab as $user => $notes)
			if (!empty($notes))
				echo "$user:".($notes["sum"] / $notes["nb"])."\n";
	}
	else if (!strcmp("ecart_moulinette", $argv[1]))
	{
		$tab = get_ecart();
		foreach ($tab as $user => $notes)
			if (!empty($notes))
				echo "$user:".($notes["sum"] / $notes["nb"] - $notes["n_sum"] / $notes["n_nb"])."\n";
	}
}

?>
