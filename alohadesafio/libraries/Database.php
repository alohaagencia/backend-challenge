<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) exit('Acesso não permitido ao diretorio');
/**
 * Database class
 */
class Database

	{
	private static $PDO;
	private static $config;
	protected $where;
	public

	function __construct()
		{
		if (!extension_loaded('pdo')) die('A extensão PDO é necessária.');
		self::$config = config_load('database');
		self::connect();
		}

	public

	function connect()
		{
		if (empty(self::$config['driver'])) die('Defina um driver de banco de dados válido para database.php');
		$driver = strtoupper(self::$config['driver']);
		switch ($driver)
			{
		case 'MYSQL':
			try
				{
				self::$PDO = new PDO('mysql:host=' . self::$config['hostname'] . ';dbname=' . self::$config['dbname'], self::$config['username'], self::$config['password']);
				self::$PDO->query('SET NAMES ' . self::$config['char_set']);
				}

			catch(PDOException $exception)
				{
				die($exception->getMessage());
				}

			return self::$PDO;
			break;

		default:
			die('Este driver de banco de dados não oferece suporte a: ' . self::$config['driver']);
			}
		}

	public

	function query($statement)
		{
		try
			{
			return self::$PDO->query($statement);
			}

		catch(PDOException $exception)
			{
			die($exception->getMessage());
			}
		}

	public

	function row_count($statement)
		{
		try
			{
			return self::$PDO->query($statement)->rowCount();
			}

		catch(PDOException $exception)
			{
			die($exception->getMessage());
			}
		}

	public

	function fetch_all($statement, $fetch_style = PDO::FETCH_ASSOC)
		{
		try
			{
			return self::$PDO->query($statement)->fetchAll($fetch_style);
			}

		catch(PDOException $exception)
			{
			die($exception->getMessage());
			}
		}

	public

	function fetch_row_assoc($statement)
		{
		try
			{
			return self::$PDO->query($statement)->fetch(PDO::FETCH_ASSOC);
			}

		catch(PDOException $exception)
			{
			die($exception->getMessage());
			}
		}

	public

	function last_insert_id()
		{
		return self::$PDO->lastInsertId();
		}

	public

	function where($value)
		{
		$this->where = $value;
		return $this;
		}

	public

	function insert($table, $values)
		{
		try
			{
			foreach($values as $key => $value) $field_names[] = $key . ' = :' . $key;
			$sql = "INSERT INTO " . $table . " SET " . implode(', ', $field_names);
			$stmt = self::$PDO->prepare($sql);
			foreach($values as $key => $value) $stmt->bindValue(':' . $key, $value);
			$stmt->execute();
			}

		catch(PDOException $exception)
			{
			die($exception->getMessage());
			}
		}

	public

	function update($table, $values)
		{
		try
			{
			foreach($values as $key => $value) $field_names[] = $key . ' = :' . $key;
			$sql = "UPDATE " . $table . " SET " . implode(', ', $field_names) . " ";
			$counter = 0;
			foreach($this->where as $key => $value)
				{
				if ($counter == 0)
					{
					$sql.= "WHERE {$key} = :{$key} ";
					}
				  else
					{
					$sql.= "AND {$key} = :{$key} ";
					}

				$counter++;
				}

			$stmt = self::$PDO->prepare($sql);
			foreach($values as $key => $value) $stmt->bindValue(':' . $key, $value);
			foreach($this->where as $key => $value) $stmt->bindValue(':' . $key, $value);
			$stmt->execute();
			}

		catch(PDOException $exception)
			{
			die($exception->getMessage());
			}
		}

	public

	function delete($table)
		{
		$sql = "DELETE FROM " . $table . " ";
		$counter = 0;
		foreach($this->where as $key => $value)
			{
			if ($counter == 0)
				{
				$sql.= "WHERE {$key} = :{$key} ";
				}
			  else
				{
				$sql.= "AND {$key} = :{$key} ";
				}

			$counter++;
			}

		$stmt = self::$PDO->prepare($sql);
		foreach($this->where as $key => $value) $stmt->bindValue(':' . $key, $value);
		$stmt->execute();
		}
	}

?>