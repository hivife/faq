<?php

if(isset($_GET['private'])){
	$private = $_GET['private'];
}
if(isset($_GET['userid'])){
	$userid = $_GET['userid'];
}
$question = $_GET['question'];
$category = $_GET['category'];


//puts new questions in database
// userid and private are only needed if question is private
//no return value


$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "mydb";

if(isset($question) && isset($category)){
	$conn = new PDO("mysql:host=$dbservername;dbname=myDB", $dbusername, $dbpassword);
	if(isset($private) && isset($userid)){
		$sql = "INSERT INTO qa (question,category,userid, private) VALUES (?,?,?,'1');";
		$temp = $conn->prepare($sql);
		$temp->execute([$question,$category,$userid]);
		echo 1;
	}
	else{
		$sql = "INSERT INTO qa (question,category, private) VALUES (?,?,'0');";
		$temp = $conn->prepare($sql);
		$temp->execute([$question,$category]);
		echo 1;
	}

	
}
else{	
	echo 0;
}
?>