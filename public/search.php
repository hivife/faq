<?php header('Content-Type:application/json');

if(isset($_POST['token'])){
	$token = $_POST['token'];
}
else{
	$token = 0;
}

if(isset($_POST['keyword'])){
	$keyword = strtolower($_POST['keyword']);
}

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "mydb";
$result = array();
$counter = 0;
$auth = false;
$conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
$sql1 = "SELECT question,answer,category_id,question_id FROM qa WHERE private = 0 AND (LOWER(answer) LIKE :search OR LOWER(question) LIKE :search )ORDER BY helpful ";
$sql2 = "SELECT question,answer,category_id,question_id FROM qa WHERE (LOWER(answer) LIKE :search OR LOWER(question) LIKE :search )ORDER BY helpful";
$sql3 = "SELECT * FROM user WHERE token = :token";

$temp = $conn->prepare($sql3);
$temp->execute(array('token' => $token));
if($temp->rowCount() != 0){
	$auth = true;
}
if(!$conn){	
	$result['status'] = 0;
	$result['message'] = "Connection failed: " . $e->getMessage();
	die(json_encode($result));
}
$temp = $conn->prepare($sql1);
$temp->execute(array('search' => "%".$keyword."%"));
$result = $temp->fetchAll(PDO::FETCH_ASSOC);
/*
$result['status'] = 1;
foreach($temp as $item){
	$result['question'.$counter] = $item['question'];
	$result['answer'.$counter] = $item['answer'];
	$result['category'.$counter] = $item['category'];	foreach($temp as $item){
		$result['question'.$counter] = $item['question'];
		$result['answer'.$counter] = $item['answer'];
		$result['category'.$counter] = $item['category'];
		$counter++;
}
	$counter++;
}*/


if($auth){
	$temp = $conn->prepare($sql2);
	$temp->execute(array('search' => "%".$keyword."%"));
	$result = $temp->fetchAll(PDO::FETCH_ASSOC);
}

echo json_encode($result);
?>