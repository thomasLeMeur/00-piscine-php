<?php
require_once 'Vertex.class.php';
require_once 'Vector.class.php';
Class Matrix
{
	public static $verbose = False;
	const IDENTITY = 1;
	const SCALE = 2;
	const RX = 4;
	const RY = 8;
	const RZ = 16;
	const TRANSLATION = 32;
	const PROJECTION = 64;

	private $_mat = NULL;
	private $_type = 0;

	public static function doc()
	{
		return (PHP_EOL . file_get_contents("Matrix.doc.txt"));
	}

	private function _checkArgs( array $kwargs )
	{
		if (array_key_exists("preset", $kwargs) === FALSE
			|| !($kwargs["preset"] & (self::IDENTITY | self::SCALE
			| self::RX | self::RY | self::RZ | self::TRANSLATION
			| self::PROJECTION)))
			return (FALSE);
		if ($kwargs["preset"] === self::SCALE
			&& array_key_exists("scale", $kwargs) === FALSE)
			return (FALSE);
		else if ($kwargs["preset"] & (self::RX | self::RY | self::RZ)
			&& array_key_exists("angle", $kwargs) === FALSE)
			return (FALSE);
		else if ($kwargs["preset"] === self::TRANSLATION
			&& (array_key_exists("vtc", $kwargs) === FALSE
			|| is_numeric($kwargs["vtc"], "Vector") === FALSE))
			return (FALSE);
		else if ($kwargs["preset"] === self::PROJECTION
			&& (array_key_exists("fov", $kwargs) === FALSE
			|| array_key_exists("ratio", $kwargs) === FALSE
			|| array_key_exists("near", $kwargs) === FALSE
			|| array_key_exists("far", $kwargs) === FALSE))
			return (FALSE);
		else if (array_key_exists("first", $kwargs) === TRUE
			&& is_a($kwargs["first"], "Matrix") === FALSE)
			return (FALSE);
		else if (array_key_exists("second", $kwargs) === TRUE
			&& is_a($kwargs["second"], "Matrix") === FALSE)
			return (FALSE);
		return (TRUE);
	}

	private function _getMatrixName()
	{
		if ($this->_type === self::IDENTITY)
			return ("IDENTITY");
		else if ($this->_type === self::SCALE)
			return ("SCALE preset");
		else if ($this->_type === self::TRANSLATION)
			return ("TRANSLATION preset");
		else if ($this->_type === self::PROJECTION)
			return ("PROJECTION preset");
		else if ($this->_type === self::RX)
			return ("Ox ROTATION preset");
		else if ($this->_type === self::RY)
			return ("Oy ROTATION preset");
		else if ($this->_type === self::RZ)
			return ("Oz ROTATION preset");
		return ("");
	}

	private function _getIdentity()
	{
		$matrix = array(
			'vtcX' => array ( 'x' => 1.0, 'y' => 0.0, 'z' => 0.0, 'w' => 0.0 ),
			'vtcY' => array ( 'x' => 0.0, 'y' => 1.0, 'z' => 0.0, 'w' => 0.0 ),
			'vtcZ' => array ( 'x' => 0.0, 'y' => 0.0, 'z' => 1.0, 'w' => 0.0 ),
			'vtx0' => array ( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1.0 ) );
		return ($matrix);
	}

	private function _getTranslation( Vector $vtc)
	{
		$matrix = array(
			'vtcX' => array ( 'x' => 1.0, 'y' => 0.0, 'z' => 0.0, 'w' => 0.0 ),
			'vtcY' => array ( 'x' => 0.0, 'y' => 1.0, 'z' => 0.0, 'w' => 0.0 ),
			'vtcZ' => array ( 'x' => 0.0, 'y' => 0.0, 'z' => 1.0, 'w' => 0.0 ),
			'vtx0' => array ( 'x' => $vtc->getmagx(), 'y' => $vtc->getmagy(),
							'z' => $vtc->getmagz(), 'w' => 1.0 ) );
		return ($matrix);
	}

	private function _getScale( $f )
	{
		$matrix = array(
			'vtcX' => array ( 'x' => 1.0 * $f, 'y' => 0.0, 'z' => 0.0, 'w' => 0.0 ),
			'vtcY' => array ( 'x' => 0.0, 'y' => 1.0 * $f, 'z' => 0.0, 'w' => 0.0 ),
			'vtcZ' => array ( 'x' => 0.0, 'y' => 0.0, 'z' => 1.0 * $f, 'w' => 0.0 ),
			'vtx0' => array ( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1.0 ) );
		return ($matrix);
	}

	private function _getRotateX( $t )
	{
		$matrix = array(
			'vtcX' => array ( 'x' => 1.0, 'y' => 0.0, 'z' => 0.0, 'w' => 0.0 ),
			'vtcY' => array ( 'x' => 0.0, 'y' => cos($t), 'z' => sin($t), 'w' => 0.0 ),
			'vtcZ' => array ( 'x' => 0.0, 'y' => -sin($t), 'z' => cos($t), 'w' => 0.0 ),
			'vtx0' => array ( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1.0 ) );
		return ($matrix);
	}

	private function _getRotateY( $t )
	{
		$matrix = array(
			'vtcX' => array ( 'x' => cos($t), 'y' => 0.0, 'z' => sin($t), 'w' => 0.0 ),
			'vtcY' => array ( 'x' => 0.0, 'y' => 1.0, 'z' => 0.0, 'w' => 0.0 ),
			'vtcZ' => array ( 'x' => -sin($t), 'y' => 0.0, 'z' => cos($t), 'w' => 0.0 ),
			'vtx0' => array ( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1.0 ) );
		return ($matrix);
	}

	private function _getRotateZ( $t )
	{
		$matrix = array(
			'vtcX' => array ( 'x' => cos($t), 'y' => sin($t), 'z' => 0.0, 'w' => 0.0 ),
			'vtcY' => array ( 'x' => -sin($t), 'y' => cos($t), 'z' => 0.0, 'w' => 0.0 ),
			'vtcZ' => array ( 'x' => 0.0, 'y' => 0.0, 'z' => 1.0, 'w' => 0.0 ),
			'vtx0' => array ( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1.0 ) );
		return ($matrix);
	}

	private function _getProjection( $fov, $ratio, $near, $far )
	{
		$matrix = array(
			'vtcX' => array ( 'x' => 1 / tan(deg2rad($fov) / 2) / $ratio,
				'y' => 0.0, 'z' => 0.0, 'w' => 0.0 ),
			'vtcY' => array ( 'x' => 0.0, 'y' => 1 / tan(deg2rad($fov) / 2),
				'z' => 0.0, 'w' => 0.0 ),
			'vtcZ' => array ( 'x' => 0.0, 'y' => 0.0,
				'z' => -($far + $near) / ($far - $near), 'w' => -1.0 ),
			'vtx0' => array ( 'x' => 0.0, 'y' => 0.0,
				'z' => -2 * ($near * $far) / ($far - $near), 'w' => 0.0 ) );
		return ($matrix);
	}

	private function _getMerge( Matrix $first, Matrix $second )
	{
		$m1 = array();
		$m2 = $first->getmatrix();
		$m3 = $second->getmatrix();
		foreach ($first->getmatrix() as $k1 => $v1)
		{
			foreach($v1 as $k2 => $v2)
			{
				$m1[$k1][$k2] = $m3[$k1]['x'] * $m2['vtcX'][$k2]
					+ $m3[$k1]['y'] * $m2['vtcY'][$k2]
					+ $m3[$k1]['z'] * $m2['vtcZ'][$k2]
					+ $m3[$k1]['w'] * $m2['vtx0'][$k2];
			}
		}
		return ($m1);
	}

	public function __construct( array $kwargs )
	{
		if ($this->_checkArgs($kwargs) === FALSE)
			return;
		$this->_type = $kwargs["preset"];
		if (array_key_exists("first", $kwargs) === TRUE
			&& array_key_exists("second", $kwargs) === TRUE)
		{
			$this->_mat = $this->_getMerge($kwargs["first"], $kwargs["second"]);
			return;
		}
		else if ($this->_type === self::IDENTITY)
			$this->_mat = $this->_getIdentity();
		else if ($this->_type === self::TRANSLATION)
			$this->_mat = $this->_getTranslation($kwargs["vtc"]);
		else if ($this->_type === self::SCALE)
			$this->_mat = $this->_getScale($kwargs["scale"]);
		else if ($this->_type === self::RX)
			$this->_mat = $this->_getRotateX($kwargs["angle"]);
		else if ($this->_type === self::RY)
			$this->_mat = $this->_getRotateY($kwargs["angle"]);
		else if ($this->_type === self::RZ)
			$this->_mat = $this->_getRotateZ($kwargs["angle"]);
		else
			$this->_mat = $this->_getProjection($kwargs["fov"],
				$kwargs["ratio"], $kwargs["near"], $kwargs["far"]);
		if (self::$verbose === True)
			print("Matrix " . $this->_getMatrixName()
			. " instance constructed" . PHP_EOL);
	}

	public function __destruct()
	{
		if (self::$verbose === True)
			print("Matrix instance destructed" . PHP_EOL);
	}

	public function __toString()
	{
		$s = "M | vtcX | vtcY | vtcZ | vtxO\n";
		$s .= "-----------------------------\n";
		$s .= sprintf("x | %.2f | %.2f | %.2f | %.2f\n",
			$this->_mat['vtcX']['x'], $this->_mat['vtcY']['x'],
			$this->_mat['vtcZ']['x'], $this->_mat['vtx0']['x']);
		$s .= sprintf("y | %.2f | %.2f | %.2f | %.2f\n",
			$this->_mat['vtcX']['y'], $this->_mat['vtcY']['y'],
			$this->_mat['vtcZ']['y'], $this->_mat['vtx0']['y']);
		$s .= sprintf("z | %.2f | %.2f | %.2f | %.2f\n",
			$this->_mat['vtcX']['z'], $this->_mat['vtcY']['z'],
			$this->_mat['vtcZ']['z'], $this->_mat['vtx0']['z']);
		$s .= sprintf("w | %.2f | %.2f | %.2f | %.2f",
			$this->_mat['vtcX']['w'], $this->_mat['vtcY']['w'],
			$this->_mat['vtcZ']['w'], $this->_mat['vtx0']['w']);
		return ($s);
	}

	public function mult( Matrix $rhs )
	{
		return (new Matrix( array ( 'preset' => self::IDENTITY,
			'first' => $this, 'second' => $rhs ) ));
	}

	public function transformVertex( Vertex $vtx )
	{
		$m = $this->_mat;
		return (new Vertex ( array (
			'x' => $m['vtcX']['x'] * $vtx->getx() + $m['vtcY']['x'] * $vtx->gety()
			+ $m['vtcZ']['x'] * $vtx->getz() + $m['vtx0']['x'] * $vtx->getw(),
			'y' => $m['vtcX']['y'] * $vtx->getx() + $m['vtcY']['y'] * $vtx->gety()
			+ $m['vtcZ']['y'] * $vtx->getz() + $m['vtx0']['y'] * $vtx->getw(),
			'z' => $m['vtcX']['z'] * $vtx->getx() + $m['vtcY']['z'] * $vtx->gety()
			+ $m['vtcZ']['z'] * $vtx->getz() + $m['vtx0']['z'] * $vtx->getw() ) ) );
	}

	public function addvertex( Vertex $vtx )
	{
		$this->_mat['vtx0']['x'] = $vtx->getx();
		$this->_mat['vtx0']['y'] = $vtx->getx();
		$this->_mat['vtx0']['z'] = $vtx->getz();
		$this->_mat['vtx0']['w'] = $vtx->getw();
	}

	public function getmatrix()
	{
		return ($this->_mat);
	}

	public function gettype()
	{
		return ($this->_type);
	}
}
?>
