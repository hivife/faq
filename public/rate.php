<?php 

include '../functions.php';


if(isset($_GET['question']) && isset($_GET['category']) && isset($_GET['answer']) && isset($_GET['rating']) && isset($_GET['userid'])){

$question = $_GET['question'];
$category = $_GET['category'];
$rating = $_GET['rating'];
$answer = $_GET['answer'];
$userid = $_GET['userid'];

	$dbservername = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$dbname = "mydb";
	$conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);	
	if (!$conn) {
		die("Connection failed: " . $conn->connect_error);
	} 
	if($rating == 1){
		$sql = "UPDATE qa SET helpful = helpful + 1 WHERE category = ? AND question=? AND answer = ?";
		$temp = $conn->prepare($sql);
		$temp->execute([$category,$question,$answer]);
	}
	if($rating == 0){
		$sql = "UPDATE qa SET nothelpful = nothelpful + 1 WHERE category = ? AND question=? AND answer = ?";
		$temp2 = $conn->prepare($sql);
		$temp2->execute([$category,$question,$answer]);
	}

	
echo 1;
}
else{
	echo 0;
}


?>