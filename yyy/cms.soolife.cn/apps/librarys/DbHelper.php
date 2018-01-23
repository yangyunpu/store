<?php
namespace Soolife\Cms\Librarys;
class DbHelper {
	private $dbh; 
	public function __construct($db) {
		$config = array(
        		'host' => $db->host,
        		'username' => $db->username,
        		'password' => $db->password,
        		'charset' => 'UTF8',
        		'dbname' => $db->dbname
    	);
		$this->dbh = new \Phalcon\Db\Adapter\Pdo\Mysql($config); 
	}
	
	public function getDatabase()
	{
		return $this->dbh;
	}
	
	public function runExQuery($sql) {
		$preparedQuery = $this->dbh->prepare($sql); 
		$this->dbh->beginTransaction(); 
		$preparedQuery->execute(); 
		$this->dbh->commit(); 
	}
}
   

?>