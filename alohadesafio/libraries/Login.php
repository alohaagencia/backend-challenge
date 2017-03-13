<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) exit('No direct access allowed.');
/**
 * Authentication class
 */
class Login

	{
	/**
	 * Config
	 *
	 * @access private
	 */
	private static $config;
	/**
	 * Database
	 *
	 * @access private
	 */
	private $db;
	/**
	 * Session
	 *
	 * @access private
	 */
	/**
	 * Constructor
	 *
	 * @access public
	 */
	public

	function __construct()
		{
		self::$config = config_load('login');
		$this->db = new Database();
		}

	public

	function check_email($email)
		{
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if ($this->db->row_count("SELECT user_email FROM " . self::$config['table_users'] . " WHERE user_email = '" . $email . "'"))
			{
			return false;
			}
		  else
			{
			return true;
			}
		}

	public

	function checar_usuario($email, $senha)
		{
		$sql = ("SELECT idcadastro FROM " . self::$config['tabela_cadastro'] . " WHERE email = '" . $email . "' AND senha='" . sha1($senha) . "'");
		if ($this->db->row_count($sql))
			{
			$result = $this->db->fetch_row_assoc($sql);
			session_start();
			$_SESSION["idcadastro"] = $result['idcadastro'];
			return true;
			}
		  else
			{
			return false;
			}
		}

       function checar_email($email)
		{
		
			if ($this->db->row_count("SELECT idcadastro FROM " . self::$config['tabela_cadastro'] . " WHERE email = '" . $email . "'")) {		 

			return false;
			
			}
			 else 
			{
				return true;
			}

		}

	}

?>
