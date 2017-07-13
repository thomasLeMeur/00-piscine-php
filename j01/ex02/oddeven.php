#!/usr/bin/php
<?PHP

while (1)
{
	echo "Entrez un nombre: ";
	if (!($s = fgets(STDIN)))
	{
		echo "^D\n";
		break;
	}
	$s = trim($s, "\n");
	if (!is_numeric($s))
		echo "'$s' n'est pas un chiffre\n";
	else
	{
		if ($s % 2)
			echo "Le chiffre $s est Impair\n";
		else
			echo "Le chiffre $s est Pair\n";
	}
}

?>
