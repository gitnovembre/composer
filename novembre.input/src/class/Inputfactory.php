<?php namespace Novembre\Input;

use Novembre\Input\Text;
use Novembre\Input\Textarea;
use Novembre\Input\Select;
use Novembre\Input\Radio;
use Novembre\Input\Checkbox;
use Novembre\Input\File;

class InputFactory
{
	private static $input;

	public static function load($type, $name)
	{
		switch($type)
		{
			case "text" : case "email" :
				return self::$input = new Text($type, $name);
			break;

			default:
				$class_name = "Novembre\\Input\\".ucfirst($type);
				return self::$input = new $class_name($name);
			break;

			return self::$input;
		}
	}

}
