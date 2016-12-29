<?php
class db {
	private $conn;
	private $host;
	private $user;
	private $password;
	private $baseName;
	//  private $Debug;

    function __construct($params=array()) {
		$this->conn = false;
		$this->host = 'localhost'; // hostname
		$this->user = 'root'; // username
		$this->password = ''; // password
		$this->baseName = 'furniture_shop'; // name of your database
		//  $this->Debug = true;
		$this->connect();
	}

	function __destruct() {
		$this->disconnect();
	}
	
	function connect() {
		if (!$this->conn) {
			try {
				$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->baseName.'', $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));  
			}
			catch (Exception $e) {
				die('Error : ' . $e->getMessage());
			}

			if (!$this->conn) {
				$this->status_fatal = true;
				echo 'Connection BDD failed';
				die();
			} 
			else {
				$this->status_fatal = false;
			}
		}

		return $this->conn;
	}

	function disconnect() {
		if ($this->conn) {
			$this->conn = null;
		}
	}
	
        // ------------ все записи из таблицы (запрос) ------------        
        function getAll($query){
            $result = $this->conn->prepare($query);
            $ret = $result->execute();
            if(!$ret){ // если запрос не удался
                echo 'SQL Error '.$query;
                die();
            }
            // режим выборки данных
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $response = $result->fetchAll();
            return $response; // массив строк таблицы запроса
        }
        
        // ------------ выбрать одну запись из таблицы по id ------------
        // результат запроса - одна строка
        function getOne($query){
            $result = $this->conn->prepare($query);
            $ret = $result->execute();
            if(!$ret){
                echo 'SQL Error '.$query;
                die();
            }
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $response = $result->fetch(); // выбирает одну строку
            return $response;
        }
        
        // ------------ метод выполнения действий (INSERT INTO, UPDATE, DELETE) ------------
        function execute($query) {
		if (!$response = $this->conn->exec($query)) {
			echo 'PDO::errorInfo():';
		   echo '<br />';
		   echo 'error SQL: '.$query;
		   die();
		}
		return $response;
	}
}
?>