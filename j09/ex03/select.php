<?php
if (file_exists("list.csv") === TRUE)
{
	$data = file_get_contents("list.csv");
	$tab = explode("\n", $data);
	foreach($tab as $line)
	{
		if ($line !== "")
		{
			$tmp = explode(";", $line);
			echo $tmp[1] . ";";
		}
	}
}
?>
