#!/usr/bin/php
<?PHP

function ft_split($s)
{
	$tab = array();
	foreach (explode(" ", $s) as $elem)
		if ($elem)
			array_push($tab, $elem);
	return ($tab);
}

if ($argc > 1)
{
	$tab = ft_split($argv[1]);
	$size = count($tab);
	for ($i = 0 ; $i < $size ; $i++)
	{
		echo $tab[$i];
		if ($i < $size - 1)
			echo " ";
	}
	echo "\n";
}

?>
