<?PHP

$action = NULL;
$name = NULL;
$value = NULL;

function ft_set()
{
	global $name, $value;
	if ($name !== NULL && $value !== NULL)
	{
		setcookie($name, $value);
		$name = NULL;
		$value = NULL;
	}
}

function ft_get()
{
	global $name;
	if ($name !== NULL)
	{
		if ($_COOKIE[$name])
			echo "$_COOKIE[$name]\n";
		$name = NULL;
	}
}

function ft_del()
{
	global $name;
	if ($name !== NULL)
	{
		setcookie($name, 0, 3600 * 24);
		unset ($_COOKIE[$name]);
		$name = NULL;
	}
}

foreach ($_GET as $key => $val)
{
	if ($key == "action" && $val == "set")
	{
		$action = "set";
		ft_set();
	}
	else if ($key == "action" && $val == "get")
	{
		$action = "get";
		ft_get();
	}
	else if ($key == "action" && $val == "del")
	{
		$action = "del";
		ft_del();
	}
	else if ($action == "set")
	{
		if ($key == "name")
		{
			$name = $val;
			ft_set();
		}
		else if ($key == "value")
		{
			$value = $val;
			ft_set();
		}
	}
	else if ($action == "get")
	{
		if ($key == "name")
		{
			$name = $val;
			ft_get();
		}
	}
	else if ($action == "del")
	{
		if ($key == "name")
		{
			$name = $val;
			ft_del();
		}
	}
}
?>
