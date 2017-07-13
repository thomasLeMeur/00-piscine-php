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

$i = 0;
$env = array();
while (++$i < $argc)
{
	$tab = ft_split($argv[$i]);
	foreach ($tab as $s)
		array_push($env, $s);
}
if (asort($env))
{
	foreach($env as $s)
		echo "$s\n";
}

?>
