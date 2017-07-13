<?php
class UnholyFactory
{
	private $_models = array();

	public function absorb( $model )
	{
		if (!($model instanceof Fighter))
			print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
		else
		{
			$is_already = NULL;
			if ($model instanceof Footsoldier)
				$key = "foot soldier";
			else if ($model instanceof Archer)
				$key = "archer";
			else if ($model instanceof Assassin)
				$key = "assassin";
			if ($model instanceof Llama)
				$key = "llama";
			if (array_key_exists($key, $this->_models) === False)
				$this->_models[$key] = $model;
			else
				$is_already = " already";
			print("(Factory$is_already absorbed a fighter of type $key)" . PHP_EOL);
		}
	}

	public function fabricate( $class )
	{
		if (array_key_exists($class, $this->_models) === True)
			print("(Factory fabricates a fighter of type $class)" . PHP_EOL);
		else
			print("(Factory hasn't absorbed any fighter of type $class)" . PHP_EOL);
		return (isset($this->_models[$class]) ? $this->_models[$class] : NULL);
	}
}
?>
