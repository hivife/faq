<?php
if(isset($_GET['username']) && isset($_GET['password'])){
	$username = $_GET['username'];
$password = $_GET['password'];
}
if(isset($_GET['userid'])){
	$userid = $_GET['userid'];
}

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "mydb";
$token = bin2hex(random_bytes(64));

if(isset($username) && isset($password)){

	try {
		$conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
		$sql = "SELECT * FROM user WHERE username= :name";	
		$temp = $conn-> prepare($sql);
		$temp->execute(array('name' => $username));
		foreach ($temp as $item){
			if($item['password'] == $password){
				$sql = "UPDATE user SET id = :token , validate = current_timestamp() WHERE username = :name AND password = :password";
				$temp = $conn-> prepare($sql);
				$temp->execute(array('name' => $username,'token' => $token,'password' => $password));
				echo $token;
			}
			else{
				echo 0;
			}	
		}
	}
	catch(PDOException $e)
		{
		echo "Connection failed: " . $e->getMessage();
		}
		
	}
	elseif(isset($userid)){
		$conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
		$sql = "SELECT * FROM user WHERE id= :id";	
		$temp = $conn-> prepare($sql);
		$temp->execute(array('id' => $userid));
		foreach ($temp as $item){
		$diff = abs(strtotime($item['validate']) - strtotime(date("Y-m-d h:i:s")));
		if($diff < 10000000000){
			echo 1;
		}
		}
	}
	
else {
	echo 0;
}
?>