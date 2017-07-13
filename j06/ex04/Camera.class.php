<?php
require_once 'Vertex.class.php';
require_once 'Vector.class.php';
require_once 'Matrix.class.php';
Class Camera
{
	public static $verbose = False;

	private $_viewMat = 0;
	private $_projMat = 0;

	public static function doc()
	{
		return (PHP_EOL . file_get_contents("Camera.doc.txt"));
	}

	public function __construct( array $kwargs )
	{
		if (array_key_exists("origin", $kwargs) === TRUE
			&& is_a($kwargs["origin"], "Vertex") === TRUE)
			$vtx = $kwargs["origin"];
		else
			$vtx = new Vertex ( array ( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0 ) );
		$mat1 = (new Matrix ( array ( 'preset' => Matrix::IDENTITY ) ));
		$mat1->addvertex($vtx->opposite());
		if (array_key_exists("orientation", $kwargs) === TRUE
			&& is_a($kwargs["orientation"], "Matrix") === TRUE)
			$mat2 = $kwargs["orientation"];
		else
			$mat2 = new Matrix( array ( 'preset' => Matrix::IDENTITY ) );
		$this->_viewMat = $mat2->mult($mat1);
		if (array_key_exists("width", $kwargs) === TRUE
			&& array_key_exists("height", $kwargs) === TRUE
			&& array_key_exists("ratio", $kwargs) === FALSE)
			$ratio = $kwargs["width"] / $kwargs["height"];
		else if (array_key_exists("width", $kwargs) === FALSE
			&& array_key_exists("height", $kwargs) === FALSE
			&& array_key_exists("ratio", $kwargs) === TRUE)
			$ratio = $kwargs["ratio"];
		else
			$ratio = 640 / 480;
		if (array_key_exists("fov", $kwargs) === TRUE)
			$fov = $kwargs["fov"];
		else
			$fov = 60;
		if (array_key_exists("near", $kwargs) === TRUE)
			$near = $kwargs["near"];
		else
			$near = 1.0;
		if (array_key_exists("far", $kwargs) === TRUE)
			$far = $kwargs["far"];
		else
			$far = -50.0;
		$this->_projMat = new Matrix ( array ( 'preset' => Matrix::PROJECTION, 'fov' => $fov,
			'ratio' => $ratio, 'near' => $near, 'far' => $far ) );
		if (self::$verbose === True)
		{
			print("Camera instance constructed" . PHP_EOL);
			print("Camera( ". PHP_EOL);
			print("+ Origine: $vtx" . PHP_EOL);
			print("+ tT:\n$mat1" . PHP_EOL);
			print("+ tR:\n$mat2" . PHP_EOL);
			print("+ tR->mult( tT ):\n$this->_viewMat" . PHP_EOL);
			print("+ Proj:\n$this->_projMat" . PHP_EOL);
			print(")");
		}
	}

	public function __destruct()
	{
		if (self::$verbose === True)
			print("Camera instance destructed" . PHP_EOL);
	}

	public function __toString()
	{
		return ("");
	}

	public function watchVertex( Vertex $worldVertex )
	{
		$vtx1 = $this->_viewMat->transformVertex($worldVertex);
		$vtx2 = $this->_projMat->transformVertex($vtx1);
		return (new Vertex ( array ( 'x' => (int)$vtx2->getx(),
			'y' => (int)$vtx2->gety(), 'z' => (int)0 ) ));
	}
}
?>
