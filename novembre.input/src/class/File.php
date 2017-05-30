<?php namespace Novembre\Input;

use Novembre\Input\Input;

class File extends Input
{
	public $name;
	public $isMultiple = false;
	public function __construct($name="")
	{
		$this->name = $name;
		$this->addAttributes(array(
			'type' => 'file',
			'name' => $this->name
		));
	}
	public function multiple()
	{
		$this->isMultiple = true;
		$this->removeAttribute('name');
		$this->addAttributes(array(
			'multiple' => "true",
			'name' => $this->name.'[]'
		));
		return $this;
	}

}
