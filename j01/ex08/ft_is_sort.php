<?PHP

function ft_is_sort($tab)
{
	$tmp1 = $tab;
	$tmp2 = $tab;
	asort($tmp1);
	arsort($tmp2);
	return ($tab === $tmp1 || $tab === $tmp2);
}

?>
