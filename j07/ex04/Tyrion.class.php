<?php
class Tyrion extends Lannister
{
	public function __construct()
	{
		$this->_identity = "Tyrion";
	}

	public function sleepWith( $other )
	{
		if (method_exists($other, "getIdentity") == True)
			print("Not even if I'm drunk !" . PHP_EOL);
		else
			print("Let's do this." . PHP_EOL);
	}
}
?>
