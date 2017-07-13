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

function my_sort_function($a, $b)
{
	$a = strtolower($a);
	$b = strtolower($b);
	$sa = strlen($a);
	$sb = strlen($b);
	$i = 0;
	$ca = ord($a[$i]);
	$cb = ord($b[$i]);
	while ($i < $sa && $i < $sb)
	{
		$ca = ord($a[$i]);
		$cb = ord($b[$i]);
		if ($ca == $cb)
		{
			$i++;
			continue;
		}
		if ($ca >= ord("a") && $ca <= ord("z"))
		{
			if ($cb >= ord("a") && $cb <= ord("z"))
				return ($ca - $cb);
			else
				return (-1);
		}
		if ($cb >= ord("a") && $cb <= ord("z"))
			return (1);
		if ($ca >= ord("0") && $ca <= ord("9"))
		{
			if ($cb >= ord("0") && $cb <= ord("9"))
				return ($ca - $cb > 0);
			else
				return (-1);
		}
		if ($cb >= ord("0") && $cb <= ord("9"))
			return (1);
		return ($ca - $cb > 0);
	}
	return ($ca - $cb);
}

$i = 0;
$env = array();
while (++$i < $argc)
{
	$tab = ft_split($argv[$i]);
	foreach ($tab as $s)
		array_push($env, $s);
}
if (uasort($env, 'my_sort_function'))
	foreach($env as $s)
		echo "$s\n";

?>
