#!/usr/bin/php
<?PHP

function ft_split($s)
{
	$tab = array();
	foreach (explode(" ", $s) as $elem)
		if (!empty($elem))
			array_push($tab, $elem);
	return ($tab);
}

if ($argc > 1)
{
	$i = 0;
	$tab = ft_split($argv[1]);
	if (($size = count($tab)))
	{
		while (++$i < $size)
			echo $tab[$i]." ";
		echo $tab[0]."\n";
	}
}

?>
