<?php namespace Novembre\Input;

use Novembre\Input\Input;

class Textarea extends Input
{
	public $textarea_value;
	public function __construct($name="")
	{
		$this->name = $name;
		$this->addAttributes(array(
			'name' => $this->name,
			'role' => "textbox",
			'aria-multiline' => "true"
		));
	}
	public function value($value)
	{
		$this->textarea_value = $value;
		return $this;
	}

}
