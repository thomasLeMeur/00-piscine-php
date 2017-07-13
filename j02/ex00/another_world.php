#!/usr/bin/php
<?PHP

if ($argc > 1)
{
	$s = preg_replace("#[ |\t]{1,}#", " ", $argv[1]);
	$s = preg_replace("#^[ |\t]|[ |\t]$#", "", $s);
	echo "$s\n";
}

?>
