<?php
if (isset($_GET[data]))
{
	$data = file_get_contents("list.csv");
	$tab = explode("\n", $data);
	$str = "";
	foreach($tab as $line)
	{
		if ($line !== "")
		{
			$tmp = explode(";", $line);
			if ($tmp[1] !== $_GET["data"])
				$str .= $line . "\n";
		}
	}
	file_put_contents("list.csv", $str);
	echo $str;
}
?>
