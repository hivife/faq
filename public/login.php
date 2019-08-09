<?php header('Content-Type:application/json');
if(isset($_POST['username']) && isset($_POST['password'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
}
if(isset($_POST['token'])){	
	$token = $_POST['token'];
}

$dbservername = "localhost";
$dbusername = "root";		
$dbpassword = "";
$dbname = "mydb";
$token = bin2hex(random_bytes(64));
$result = array();

if(isset($username) && isset($password)){
	try {
		$conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
		$sql = "SELECT * FROM user WHERE username= :name";	
		$temp = $conn-> prepare($sql);
		$temp->execute(array('name' => $username));
		if($temp->rowCount() != 0){
			foreach ($temp as $item){
			if($item['password'] == $password){
				$sql1 = "UPDATE user SET token = :token , validate = current_timestamp() WHERE username = :name AND password = :password";
				$temp = $conn-> prepare($sql1);
				echo $temp->execute(array('name' => $username,'token' => $token,'password' => $password));
				$result['status'] = 1;
				$result['message'] = $token;
				echo json_encode($result);
			}
			else{
				$result['status'] = 0;
				$result['message'] = "wrong username or password";
				echo json_encode($result);
			}	
		}
		}
		else{
			$result['status'] = 0;
			$result['message'] = "wrong username or password";
			echo json_encode($result);
		}
		
	}
	catch(PDOException $e)
		{
		$result['message'] =  "Connection failed: " . $e->getMessage();
		$result['status'] = 0;
		echo json_encode($result);
		}
		
	}
elseif(isset($token)){
		$conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
		$sql = "SELECT * FROM user WHERE token= :token";	
		$temp = $conn-> prepare($sql);
		$temp->execute(array('token' => $token));
		foreach ($temp as $item){
		$diff = abs(strtotime($item['validate']) - strtotime(date("Y-m-d h:i:s")));
		if($diff < 100000){
			$result['message'] =  "Token invalid";
			$result['status'] = 0;
			echo json_encode($result);
		}
		else{
			$result['status'] = 1;
			echo json_encode($result);
		}
		}
	}
	
else {
	$result['message'] =  "invalid parameters";
	$result['status'] = 0;
	echo json_encode($result);
}
?>