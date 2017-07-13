<?php
class Lannister
{
	const LANNISTER = 1;
	protected $_identity = 0;

	public function getIdentity()
	{
		return ($this->_identity);
	}

	public function getFamily()
	{
		return (self::LANNISTER);
	}
}
?>
