<?php

class User{
	public function getUser($username, $password){
		global $conn;
		$sql = "SELECT * FROM usuario_inv WHERE nombre = '$username' AND password = '$password' ";
		$result = $conn->query($sql);
		$numRows = $result->num_rows;
		if($numRows == 1){
			return true;
		}
		return false;
	}
}

?>