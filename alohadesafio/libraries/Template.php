<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) exit('No direct access allowed.');
/**
 * Template class
 */
class Template

	{
	private static $config;
	private $tpl_path = null;
	private $values = array();
	public

	function __construct($tpl_path)
		{
		self::$config = config_load('template');
		$this->tpl_path = $tpl_path;
		}

	public

	function set($name, $value = null)
		{
		if (is_array($name))
			{
			foreach($name as $key => $value)
				{
				$this->values[$key] = $value;
				}
			}
		  else
			{
			$this->values[$name] = $value;
			}
		}

	public

	function display($template)
		{
		if ($this->values)
			{
			extract($this->values);
			}

		if (file_exists($this->tpl_path . $template . self::$config['template_extension']))
			{
			ob_start();
			include ($this->tpl_path . $template . self::$config['template_extension']);

			$output = ob_get_contents();
			ob_end_clean();
			}
		  else
			{
			die('O Arquivo do tema  ' . $this->tpl_path . $template . self::$config['template_extension'] . ' não foi encontrado.');
			}

		if ($output) echo $output;
		}
	}

?>