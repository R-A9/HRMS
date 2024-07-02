<?php  



$sname = "localhost";

$uname = "root";

$password = "";



$db_name = "hrms";

date_default_timezone_set('Asia/Manila');



$conn = mysqli_connect($sname, $uname, $password, $db_name);



if (!$conn) {

	echo "Connection Failed!";

	exit();

}