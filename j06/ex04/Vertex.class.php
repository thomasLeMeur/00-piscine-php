<?php
require_once 'Color.class.php';
Class Vertex
{
	public static $verbose = False;

	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 0;
	private $_color = NULL;

	public static function doc()
	{
		return (PHP_EOL . file_get_contents("Vertex.doc.txt"));
	}

	public function __construct( array $kwargs )
	{
		if (array_key_exists("x", $kwargs) === FALSE
			|| array_key_exists("y", $kwargs) === FALSE
			|| array_key_exists("z", $kwargs) === FALSE)
			return;
		$this->_x = $kwargs["x"];
		$this->_y = $kwargs["y"];
		$this->_z = $kwargs["z"];
		if (array_key_exists("w", $kwargs) === TRUE)
			$this->_w = $kwargs["w"];
		else
			$this->_w = 1.0;
		if (array_key_exists("color", $kwargs) === TRUE
			&& is_a($kwargs["color"], "Color") === TRUE)
			$this->_color = $kwargs["color"];
		else
			$this->_color = new Color( array(
				"red" => 255, "green" => 255, "blue" => 255 ) );
		if (self::$verbose === True)
			print($this . " constructed" . PHP_EOL);
	}

	public function __destruct()
	{
		if (self::$verbose === True)
			print($this . " destructed" . PHP_EOL);
	}

	public function __toString()
	{
		$s = sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f",
			$this->_x, $this->_y, $this->_z, $this->_w);
		if (self::$verbose === True)
			$s .= ", " . $this->_color;
		return ($s . " )");
	}

	public function getx()
	{
		return ($this->_x);
	}

	public function gety()
	{
		return ($this->_y);
	}

	public function getz()
	{
		return ($this->_z);
	}

	public function getw()
	{
		return ($this->_w);
	}

	public function getcol()
	{
		return ($this->_col);
	}

	public function setx( $val )
	{
		$this->_x = $val;
	}

	public function sety( $val )
	{
		$this->_y = $val;
	}

	public function setz( $val )
	{
		$this->_z = $val;
	}

	public function setw( $val )
	{
		$this->_w = $val;
	}

	public function setcol( Color $val )
	{
		$this->_col = $val;
	}

	public function opposite()
	{
		return (new Vertex ( array ( 'x' => $this->_x * -1,
			'y' => $this->_y * -1, 'z' => $this->_z * -1 ) ));
	}
}
?>
