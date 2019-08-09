<?php 


$result = array();

if(isset($_POST['question_id']) && isset($_POST['rating'])){

$question_id = $_POST['question_id'];
$rating = $_POST['rating'];	

	$dbservername = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$dbname = "mydb";
	$conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);	
	if (!$conn) {
		die("Connection failed: " . $conn->connect_error);
	} 
	if($rating == 1){
		$sql = "UPDATE qa SET helpful = helpful + 1 WHERE question_id = :id";
		$temp = $conn->prepare($sql);
		$temp->execute(array('id' => $question_id));
	}
	if($rating == 0){
		$sql = "UPDATE qa SET nothelpful = nothelpful + 1 WHERE question_id = :id";
		$temp2 = $conn->prepare($sql);
		$temp2->execute(array('id' => $question_id));
	}

	$result['message'] = "successful";
	$result['question_id'] = $question_id;
	$result['status'] = 1;
	echo json_encode($result);
}
else{
	$result['message'] = "not successful";
	$result['question_id'] = $question_id;
	$result['status'] = 0;
	echo json_encode($result);
}


?>