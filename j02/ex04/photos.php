#!/usr/bin/php
<?PHP
$i = 0;
while (++$i < $argc)
{
	$c1 = curl_init($argv[$i]);
	curl_setopt($c1, CURLOPT_RETURNTRANSFER, true);
	if (($s1 = curl_exec($c1)) !== NULL)
	{
		preg_match_all("#(src|SRC)=[\"'].*?.[gif|jpeg|jpg|png][\"']#", $s1, $names);
		foreach ($names[0] as $link)
		{
			$dir = substr(strstr($argv[$i], "://"), 3);
			$link = substr($link, 5, strlen($link) - 6);
			$c2 = curl_init($link);
			curl_setopt($c2, CURLOPT_RETURNTRANSFER, true);
			if (($s2 = curl_exec($c2)) !== NULL)
			{
				mkdir($dir, 0777, TRUE);
				file_put_contents($dir."/".strrev(strstr(strrev($link), "/", TRUE)), $s2);
			}
			curl_close($c2);
		}
	}
	curl_close($c1);
}
?>
