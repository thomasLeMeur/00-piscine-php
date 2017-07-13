<?php
Class Color
{
	public static $verbose = False;

	public $red = 0;
	public $blue = 0;
	public $green = 0;

	public static function doc()
	{
		return (PHP_EOL . file_get_contents("Color.doc.txt"));
	}

	public function __construct( array $kwargs )
	{
		if (array_key_exists("rgb", $kwargs))
		{
			$val = (int)$kwargs["rgb"];
			$this->red = (int)($val / 65536);
			$val -= (int)($this->red * 65536);
			$this->green = (int)($val / 256);
			$val -= (int)($this->green * 256);
			$this->blue = (int)$val;
		}
		else
		{
			if (array_key_exists("red", $kwargs) === TRUE)
				$this->red = (int)$kwargs["red"];
			else
				$this->red = 0;
			if (array_key_exists("blue", $kwargs) === TRUE)
				$this->blue = (int)$kwargs["blue"];
			else
				$this->blue = 0;
			if (array_key_exists("green", $kwargs) === TRUE)
				$this->green = (int)$kwargs["green"];
			else
				$this->green = 0;
		}
		if (self::$verbose === True)
		{
			print($this . " constructed." . PHP_EOL);
		}
	}

	public function __destruct()
	{
		if (self::$verbose === True)
			print($this . " destructed." . PHP_EOL);
	}

	public function __toString()
	{
		return (sprintf("Color( red: %3d, green: %3d, blue: %3d )",
			$this->red, $this->green, $this->blue));
	}

	public function add( Color $other)
	{
		$new = new Color( array (
			"red" => $this->red + $other->red,
			"green" => $this->green + $other->green,
			"blue" => $this->blue + $other->blue ));
		return ($new);
	}

	public function sub( Color $other)
	{
		$new = new Color( array (
			"red" => $this->red - $other->red,
			"green" => $this->green - $other->green,
			"blue" => $this->blue - $other->blue ));
		return ($new);
	}

	public function mult( $fact )
	{
		$new = new Color( array (
			"red" => (int)($this->red * $fact),
			"green" => (int)($this->green * $fact),
			"blue" => (int)($this->blue * $fact)));
		return ($new);
	}
}
?>
