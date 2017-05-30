<?php namespace Novembre\Input;

use Novembre\Input\Input;

class Radio extends Input
{
	public $name;
	private $options = array();
	private $hasOptions = false;
	private $checked = false;
	public function __construct($name="")
	{
		$this->name = $name;
		$this->addAttributes(array(
			'name' => $this->name,
			'type' => "radio",
			'role' => "radio"
		));
	}
	public function options($options)
	{
		if(is_array($options))
		{
			$this->hasOptions = true;
			$this->options = $options;
		}
		return $this;
	}
	public function checked($k=false)
	{
		if($k != false)
			$this->checked = $k;
		else
		{
			return $this->addAttributes(array(
				"checked" => "checked",
				"aria-checked" => "true"
			));
		}
		return $this;
	}
	public function html()
	{
		if($this->hasOptions)
			return $this->build();
		else
			return parent::build();
	}
	public function build()
	{
		$html = ""; $i=1;
		foreach($this->options as $k => $v)
		{
			$this->label_name = $v;
			$this->removeAttribute("value");
			$this->addAttributes("value" , $k);
			if($this->checked != false && $this->checked == $i)
			{
				$this->removeAttribute("checked");
				$this->removeAttribute("aria-checked");

				$this->addAttributes("checked" , "checked");
				$this->addAttributes("aria-checked" , "true");
			}
			$html .= parent::build();
			$i++;
		}
		return $html;
	}
}
