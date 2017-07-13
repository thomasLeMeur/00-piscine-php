#!/usr/bin/php
<?PHP

if ($argc > 1)
{
	$s = file_get_contents($argv[1]);
	while ($s)
	{
		echo strstr($s, "<a", TRUE);
		$s = strstr($s, "<a");
		$i = 0;
		while ($s[$i] && strncmp(substr($s, $i), "</a", 2))
		{
			if ($s[$i] == ">")
			{
				while ($s[$i] && $s[$i] != "<")
					echo strtoupper($s[$i++]);
				echo $s[$i++];
			}
			else if (!strncmp(substr($s, $i), "title=\"", 7))
			{
				echo "title=\"";
				$i += 7;
				while ($s[$i] && $s[$i] != "\"")
					echo strtoupper($s[$i++]);
				echo $s[$i++];
			}
			else
				echo $s[$i++];
		}
		$s = substr($s, $i);
	}
}

?>
