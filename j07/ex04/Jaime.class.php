<?php
class Jaime extends Lannister
{
	public function __construct()
	{
		$this->_identity = "Lannister";
	}

	public function sleepWith( $other )
	{
		if (method_exists($other, "getIdentity") == True)
		{
			if ($other->getIdentity() === "Tyrion")
				print("Not even if I'm drunk !" . PHP_EOL);
			else
				print("With pleasure, but only in a tower in Winterfall, then." . PHP_EOL);
		}
		else
			print("Let's do this." . PHP_EOL);
	}
}
?>
