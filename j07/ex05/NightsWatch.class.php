<?php
class NightsWatch
{
	private $_fighters = array();

	public function recruit( $new_one)
	{
		array_push($this->_fighters, $new_one);
	}

	public function fight()
	{
		foreach ($this->_fighters as $fighter)
			if (method_exists($fighter, "fight") === True)
				$fighter->fight();
	}
}
?>
