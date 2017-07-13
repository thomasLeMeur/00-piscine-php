<?php
if (file_exists("list.csv") === TRUE)
{
	if (isset($_GET[data]))
	{
		$data = file_get_contents("list.csv");
		$tab = explode("\n", $data);
		$id = 0;
		$str = "";
		foreach($tab as $line)
		{
			if ($line !== "")
			{
				$tmp = explode(";", $line);
				$id = $tmp[0];
				$str .= $line . "\n";
			}
		}
		$str .= strval($id + 1) . ";" . $_GET["data"] . "\n";
		file_put_contents("list.csv", $str);
		echo $str;
	}
}
?>
