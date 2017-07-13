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

function ft_epur_str($s)
{
	$res = "";
	$tab = ft_split($s);
	$size = count($tab);
	for ($i = 0 ; $i < $size ; $i++)
	{
		$res .= $tab[$i];
		if ($i < $size - 1)
			$res .= " ";
	}
	return ($res);
}

if ($argc > 3)
{
	if (!$a = trim($argv[1]))
		$a = 0;
	if (!$b = trim($argv[3]))
		$b = 0;
	$a = ft_epur_str($a);
	$b = ft_epur_str($b);
	if (!is_numeric($a))
		$a = 0;
	if (!is_numeric($b))
		$b = 0;
	$o = trim($argv[2]);
	if (strlen($o) == 1)
	{
		$o = ord($o);
		if ($o == ord("+"))
			echo ($a + $b)."\n";
		else if ($o == ord("-"))
			echo ($a - $b)."\n";
		else if ($o == ord("*"))
			echo ($a * $b)."\n";
		else if ($o == ord("/"))
			echo ($a / $b)."\n";
		else if ($o == ord("%"))
			echo ($a % $b)."\n";
	}
}
else
	echo "Incorrect Parameters\n";
?>
