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
		$res .= $tab[$i];
	return ($res);
}

function ft_get_nb($s)
{
	$i = 0;
	$f = 0;
	$res;
	if ($s[$i] === "+" || $s[$i] === '-')
		$res = $s[$i++];
	while (is_numeric($s[$i]) || ($s[$i] == "." && !$f))
	{
		if ($s[$i] == ".")
			$f = 1;
		$res .= $s[$i++];
	}
	if ($i == 1 && ($s[0] === "-" || $s[0] === "+"))
		$res = "";
	return ($res);
}

function ft_check($s)
{
	return ($s || $s === "0");
}

if ($argc > 1)
{
	$argv[1] = ft_epur_str($argv[1]);
	$a = ft_get_nb($argv[1]);
	$o = $argv[1][strlen($a)];
	$b = ft_get_nb(substr($argv[1], strlen($a) + 1));
	if (!ft_check($a) || !ft_check($b) || $argv[1][strlen($a) + 1 + strlen($b)])
		echo "Syntax Error\n";
	else
	{
		$o = ord($o);
		if ($o == ord("+"))
			echo ($a + $b)."\n";
		else if ($o == ord("-"))
			echo ($a - $b)."\n";
		else if ($o == ord("*"))
			echo ($a * $b)."\n";
		else if ($o == ord("/"))
		{
			if ($b == 0 || $b == -0)
				echo "Syntax Error\n";
			else
				echo ($a / $b)."\n";
		}
		else if ($o == ord("%"))
		{
			if ($b == 0 || $b == -0)
				echo "Syntax Error\n";
			else
				echo ($a % $b)."\n";
		}
		else
			echo "Syntax Error\n";
	}
}
else
	echo "Incorrect Parameters\n";
?>
