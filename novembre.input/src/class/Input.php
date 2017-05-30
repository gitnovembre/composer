<?php namespace Novembre\Input;

class Input
{
	public $attributes = "";
	public $id;
	public $label_name;
	public $label_slug;
	public $template = "default";
	public $input_value;
	public $text_help;
	public $addon;

	public function template($template)
	{
		$this->template = $template;
		return $this;
	}
	public function addAttributes($attr, $val="")
	{
		if(is_array($attr))
		{
			foreach($attr as $k => $v)
				$this->attributes .= $k.'="'.$v.'" ';
		}
		else
			$this->attributes .= $attr.'="'.$val.'" ';
		return $this;
	}
	public function removeAttribute($k)
	{
		$this->attributes = preg_replace('`'.$k.'\=\".*\"\ `', "", $this->attributes);
	}
	public function label($label_name)
	{
		$this->label_name = $label_name;
		$this->label_slug = $this->slugify(uniqid()."_".$label_name);
		$this->addAttributes(array('id' => $this->label_slug));
		return $this;
	}
	public function required()
	{
		return $this->addAttributes(array(
			"required" => "required",
			"aria-required" => "true"
		));
	}
	public function placeholder($v)
	{
		return $this->addAttributes("placeholder", $v);
	}
	public function help($text_help)
	{
		$this->text_help = $text_help;
		return $this;
	}
	public function addon($addon)
	{
		$this->addon = $addon;
		return $this;
	}
	public function html()
	{
		return $this->build();
	}
	public function build()
	{
        $get_called_class = end(explode('\\', get_called_class()));

		$this->id = $this->slugify($this->name);
		ob_start();
            $input = $this;
            require __DIR__.'/../views/' . strtolower($get_called_class).'-'.$this->template.'.php';
		$input = ob_get_contents(); ob_end_clean();

		return $input;
	}
	public function slugify($text)
	{
		// replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);
		// trim
		$text = trim($text, '-');
		// remove duplicate -
		$text = preg_replace('~-+~', '-', $text);
		// lowercase
		$text = strtolower($text);
		if (empty($text))
			return 'n-a';
	  	return $text;
	}
}
?>
