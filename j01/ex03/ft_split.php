<?PHP

function ft_split($s)
{
	$tab = array();
	foreach (explode(" ", $s) as $elem)
		if ($elem)
			array_push($tab, $elem);
	asort($tab);
	return ($tab);
}

?>
