#!/usr/bin/php
<?PHP

function ft_split($s)
{
	$tab = array();
	foreach (explode(" ", $s) as $elem)
		if ($elem)
			array_push($tab, $elem);
	asort($tab);
	return ($tab);
}

function ft_get_month($mois)
{
	$mois = substr($mois, 1);
	if ($mois === "anvier")
		return (1);
	if ($mois === "evrier")
		return (2);
	if ($mois === "ars")
		return (3);
	if ($mois === "vril")
		return (4);
	if ($mois === "ai")
		return (5);
	if ($mois === "uin")
		return (6);
	if ($mois === "uillet")
		return (7);
	if ($mois === "out")
		return (8);
	if ($mois === "eptembre")
		return (9);
	if ($mois === "ctobre")
		return (10);
	if ($mois === "ovembre")
		return (11);
	if ($mois === "ecembre")
		return (12);
}

if ($argc > 1)
{
	if (substr_count($argv[1], " ") != 4)
		echo "Wrong Format\n";
	else
	{
		$tab = ft_split($argv[1]);
		if (count($tab) != 5)
			echo "Wrong Format\n";
		else
		{
			if (!preg_match("#^(([L|l]un|[M|m](ar|ercre)|[J|j]eu|[V|v]endre|[S|s]ame)di|[D|d]imanche)$#", $tab[0]))
				echo "Wrong Format\n";
			else if (!preg_match("#^(([0-2]?[0-9])|(3[0-1]))$#", $tab[1]))
				echo "Wrong Format\n";
			else if (!preg_match("#^[J|j](anvier|uin|uillet)|[F|f]evrier|[M|m]a(rs|i)|[A|a](vril|out)|[M|m]ai|([S|s]eptem|[O|o]cto|[N|n]ovem|[D|d]ecem)bre$#", $tab[2]))
				echo "Wrong Format\n";
			else if (!preg_match("#\d\d\d\d$#", $tab[3]))
				echo "Wrong Format\n";
			else if (!preg_match("#(2[0-3]|[0-1]\d):[0-5]\d:[0-5]\d$#", $tab[4]))
				echo "Wrong Format\n";
			else
			{
				if (!checkdate(ft_get_month($tab[2]), $tab[1], $tab[3]))
					echo "Wrong Format\n";
				else
				{
					date_default_timezone_set("Europe/Paris");
					$tab2 = explode(":", $tab[4]);
					echo mktime($tab2[0], $tab2[1], $tab2[2], ft_get_month($tab[2]), $tab[1], $tab[3])."\n";
				}
			}
		}
	}
}

?>
