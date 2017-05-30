<?php namespace Novembre\Input;

use Novembre\Input\Input;

class Text extends Input
{
	public function __construct($type, $name="")
	{
		$this->name = $name;

		$this->addAttributes(array(
			'type' => $type,
			'name' => $name,
			'role' => "textbox"
		));
	}
	public function value($value)
	{
		$this->addAttributes('value', $value);
		return $this;
	}

}

?>
