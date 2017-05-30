<?php namespace Novembre\Input;

use Novembre\Input\Input;

class Select extends Input
{
	public $options = array();
	public $listOptions = "";
	private $selected = false;
	public function __construct($name="")
	{
		$this->name = $name;
		$this->addAttributes(array(
			'name' => $this->name,
			'role' => "listbox"
		));
	}
	public function options($options)
	{
		if(is_array($options))
			$this->options = $options;

		return $this;
	}
	public function selected($k=false)
	{
		if($k != false)
			$this->selected = $k;

		return $this;
	}
	public function html()
	{
		$i=1;
		$this->id = $this->slugify($this->name);
		foreach($this->options as $value => $display)
		{
			if($this->selected != false && $this->selected == $i)
				$this->listOptions .= '<option value="'.$value.'" selected="selected">'.$display.'</option>';
			else
				$this->listOptions .= '<option value="'.$value.'">'.$display.'</option>';
			$i++;
		}
		return parent::build();
	}

}
