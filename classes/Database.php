<?php 

/*******************************************************************
*	Sample usage:

		$db = new Database;
		$db->query("SELECT blog_id FROM blogs");
		echo $db->numRows();
		print_r($db->results();
*
********************************************************************/ 


class Database {
	protected $_link , $_result, $_numRows , $_returned_array ;

	public function __construct(){
		global $db_username, $db_password , $db_host , $db_database; 
		$this->_link = new PDO('mysql:dbname='.$db_database.';dbhost='.$db_host. '', $db_username, $db_password);
	}

	public function disconnect(){
		$this->_link = NULL;
	}

	public function query($sql){
		$this->_result = $this->_link->query($sql);
		$this->_returned_array = $this->_result->fetchAll(PDO::FETCH_ASSOC);
		$this->_numRows = count($this->_returned_array);
	}

	public function numRows(){
		return $this->_numRows;
	}

	public function results(){
		return $this->_returned_array;
	}

}

?>