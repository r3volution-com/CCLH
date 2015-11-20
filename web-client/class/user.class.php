<?php
include(dirname(__FILE__)."/db.mysql.class.php");
class User {
	var $db;
	var $uid;
	var $userdata;
	function User($uid = 0){
		$this->db = new DB();
		$this->uid = 0;
		if ($uid){
			$row = $this->db->getRow("SELECT id, username, email FROM users WHERE id=".$uid);
			if (count($row)){
				$this->uid = $row["id"];
				$this->userdata = $row;
				return true;
			} else die("Error el usuario no existe");
		}
	}
	function doLogin($username, $password){
		$row = $this->db->getRow("SELECT id, username, email FROM users WHERE (username = '".$username."' OR email = '".$username."') AND password = '".hash("sha512", $password)."'");
		if (count($row)){
			$this->uid = $row["id"];
			$this->userdata = $row;
			return true;
		} else return false;
	}
	function doRegister($username, $email, $passwd){
		$count = $this->db->getField("SELECT count(*) as cuantos FROM users WHERE username = '".$username."' OR email = '".$email."'", "cuantos");
		if ($count) return 0;
		else return $this->db->insertQuery("INSERT INTO users (username, email, password) VALUES ('".$username."', '".$email."', '".hash("sha512", $passwd)."')");
	}
	function getUID(){
		return $this->uid;
	}
	function getUserData(){
		return $this->userdata;
	}
}