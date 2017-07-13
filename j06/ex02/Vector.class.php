<?php
require_once 'Vertex.class.php';
Class Vector
{
	public static $verbose = False;

	private $_magx = 0;
	private $_magy = 0;
	private $_magz = 0;
	private $_w = 0;

	public static function doc()
	{
		return (PHP_EOL . file_get_contents("Vector.doc.txt"));
	}

	public function __construct( array $kwargs )
	{
		if (array_key_exists("dest", $kwargs) === FALSE
			|| is_a($kwargs["dest"], "Vertex") === FALSE)
			return;
		$dest = $kwargs["dest"];
		if (array_key_exists("orig", $kwargs) === TRUE
			|| is_a($kwargs["orig"], "Vertex") === TRUE)
			$orig = $kwargs["orig"];
		else
			$orig = new Vertex( array (
				'x' => 0, 'y' => 0, 'z' => 0) );
		$this->_w = 0.0;
		$this->_magx = $dest->getx() - $orig->getx();
		$this->_magy = $dest->gety() - $orig->gety();
		$this->_magz = $dest->getz() - $orig->getz();
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
		return (sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )",
			$this->_magx, $this->_magy, $this->_magz, $this->_w));
	}

	public function getmagx()
	{
		return ($this->_magx);
	}

	public function getmagy()
	{
		return ($this->_magy);
	}

	public function getmagz()
	{
		return ($this->_magz);
	}

	public function getw()
	{
		return ($this->_w);
	}

	public function magnitude()
	{
		return (sqrt($this->_magx * $this->_magx
			+ $this->_magy * $this->_magy
			+ $this->_magz * $this->_magz
			+ $this->_w * $this->_magz));
	}

	public function normalize()
	{
		if (($mag = $this->magnitude()) === 1)
			return (clone $this);
		return (new Vector ( array ( 'dest' => new Vertex ( array (
			'x' => $this->_magx / $mag, 'y' => $this->_magy / $mag,
			'z' => $this->_magz / $mag, 'w' => $this->_w / $mag)))));
	}

	public function add( Vector $rhs )
	{
		return (new Vector ( array ( 'dest' => new Vertex ( array (
			'x' => $this->_magx + $rhs->getmagx(),
			'y' => $this->_magy + $rhs->getmagy(),
			'z' => $this->_magz + $rhs->getmagz(),
			'w' => $this->_w + $rhs->getw())))));
	}

	public function sub( Vector $rhs )
	{
		return (new Vector ( array ( 'dest' => new Vertex ( array (
			'x' => $this->_magx - $rhs->getmagx(),
			'y' => $this->_magy - $rhs->getmagy(),
			'z' => $this->_magz - $rhs->getmagz(),
			'w' => $this->_w - $rhs->getw())))));
	}

	public function opposite()
	{
		return (new Vector ( array ( 'dest' => new Vertex ( array (
			'x' => $this->_magx * -1,
			'y' => $this->_magy * -1,
			'z' => $this->_magz * -1,
			'w' => $this->_w * -1)))));
	}

	public function scalarProduct( $k )
	{
		return (new Vector ( array ( 'dest' => new Vertex ( array (
			'x' => $this->_magx * $k,
			'y' => $this->_magy * $k,
			'z' => $this->_magz * $k,
			'w' => $this->_w * $k)))));
	}

	public function dotProduct( Vector $rhs )
	{
		return ($this->_magx * $rhs->getmagx()
			+ $this->_magy * $rhs->getmagy()
			+ $this->_magz * $rhs->getmagz()
			+ $this->_w * $rhs->getw());
	}

	public function crossProduct( Vector $rhs )
	{
		return (new Vector ( array ( 'dest' => new Vertex ( array (
			'x' => $this->_magy * $rhs->getmagz() - $this->_magz * $rhs->getmagy(),
			'y' => $this->_magz * $rhs->getmagx() - $this->_magx * $rhs->getmagz(),
			'z' => $this->_magx * $rhs->getmagy() - $this->_magy * $rhs->getmagx(),
			'w' => 0)))));
	}

	public function cos( Vector $rhs )
	{
		return (($this->_magx * $rhs->getmagx() + $this->_magy * $rhs->getmagy()
			+ $this->_magz * $rhs->getmagz()) / ($this->magnitude() * $rhs->magnitude()));
	}
}
?>
