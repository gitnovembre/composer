<?php namespace Novembre\Input;

use Novembre\Input\Input;

class Checkbox extends Input
{
	public function __construct($name="")
	{
		$this->addAttributes(array(
			'name' => $name,
			'role' => "checkbox"
		));
	}
}
