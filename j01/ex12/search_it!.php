#!/usr/bin/php
<?PHP

if ($argc > 1)
{
	$size = count($argv) - 2;
	$len = strlen($argv[1]);
	$i = $argc;
	while (--$i > 1)
		if (($argv[1] || $argv[1] === "0") && strpos($argv[$i], $argv[1]) === 0)
			if ($argv[$i][$len] == ":" && $argv[$i][$len + 1])
			{
				echo substr($argv[$i], $len + 1)."\n";
				break;
			}
}

?>
