<?php

function get_questions($userid){
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "mydb";
//returns private and public questions for param userid
	$result = array();
	$counter = 0;
	$conn = new PDO("mysql:host=$dbservername;dbname=myDB", $dbusername, $dbpassword);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$sql1 = "SELECT question,answer,category FROM qa WHERE private = 1 AND userid ='".$userid."'";
	$sql2 = "SELECT question,answer,category FROM qa WHERE private = 0";
	foreach ($conn->query($sql1) as $item){
		$result[$counter] = $item;
		$counter++;
	}
	foreach ($conn->query($sql2) as $item){
		$result[$counter] = $item;
		$counter++;
	}
	$result[$counter] = $counter;
	echo json_encode($result);	
	
}

function login($username,$password){
	$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "mydb";

//returns userid on successful login,0 on failed login, error message on error
if(isset($username) && isset($password) ){

	try {
		$conn = new PDO("mysql:host=$dbservername;dbname=myDB", $dbusername, $dbpassword);
		$sql = "SELECT * FROM user WHERE username='".$username."'";	
		foreach ($conn->query($sql) as $item){
			if($item['password'] == $password){
				echo $item['id'];
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
	
else {
	echo 0;
}
}

function ask_question($question,$category,$userid,$private){
	
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "mydb";

if(isset($question) && isset($category)){
	$conn = new PDO("mysql:host=$dbservername;dbname=myDB", $dbusername, $dbpassword);
	if (!$conn) {
		die("Connection failed: " . $conn->connect_err,,or);
	} 
	if(isset($private) && isset($userid)){
		$sql = "INSERT INTO qa (question,category,userid, private) VALUES (?,?,?,'1');";
		$temp = $conn->prepare($sql);
		$temp->execute([$question,$category,$userid]);
	}
	else{
		$sql = "INSERT INTO qa (question,category, private) VALUES (?,?,'0');";
		$temp = $conn->prepare($sql);
		$temp->execute([$question,$category]);
	}

	
}
else{	
	echo 0;
}
//TODO: Like button

function rate($question,$category,$answer,$rating){
	
	$dbservername = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$dbname = "mydb";
	
	$conn = new PDO("mysql:host=$dbservername;dbname=myDB", $dbusername, $dbpassword);	
	if (!$conn) {
		die("Connection failed: " . $conn->connect_err,,or);
	} 
	if($rating == 1){
		$sql = "UPDATE qa SET helpful = helpful+1, WHERE answer = ? AND question = ? AND category = ?;";
		$temp = $conn->prepare($sql);
		$temp->execute([$answer,$question,$category]);
	}
	if($rating == 0){
		$sql = "UPDATE qa SET nothelpful = nothelpful+1, WHERE answer = ? AND question = ? AND category = ?;";
		$temp = $conn->prepare($sql);
		$temp->execute([$answer,$question,$category]);
	}
	

	
	
}

}