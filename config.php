<?php
	define('DB_SERVER','localhost');
	define('DB_USERNAME','root');
	define('DB_PASSWORD','');
	define('DB_NAME','online_shopping');

	$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if(!$mysqli)
	{
		die("ERROR: Could not connect. ". $mysqli->connect_error);
	}
class product
{
	public  function update_query($sql){
		$result=mysqli_query($this->mysqli,$sql);
		if(!$result){
			echo "Error";
		}
	}
}
?>