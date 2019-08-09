<?php header('Content-Type:application/json');

if(isset($_POST['token'])){
	$token = $_POST['token'];
}
else{
	$token = 0;
}
if(isset($_POST['category_id'])){
	$category_id = $_POST['category_id'];

}




$dbservername = "localhost";	
$dbusername = "root";
$dbpassword = "";
$dbname = "mydb";
$result = array();
$counter = 0;
$auth = false;
$conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
$sql1 = "SELECT question,answer,question_id,category_id FROM qa WHERE category_id = :id ";
$sql2 = "SELECT question,answer,question_id,category_id FROM qa WHERE private = 0 AND category_id = :id";
$sql3 = "SELECT * FROM user WHERE token = :token";

$temp = $conn->prepare($sql3);
$temp->execute(array('token' => $token));
if($temp->rowCount() != 0){
	$auth = true;
}

//returns private and public questions for param token $conn->query($sql1)
if(isset($category_id)){
	if($auth){
		$temp = $conn->prepare($sql1);
		$temp->execute(array('id' => $category_id));
		/*foreach ( $temp as $item){
			$result['question'.$counter] = $item['question'];
			$result['answer'.$counter] = $item['answer'];
			$result['question_id'.$counter] = $item['question_id'];
			$result['private'] = $item['private'];
			$counter++;
		}
		$temp = $conn->prepare($sql2);
		$temp->execute(array('id' => $category_id));
		foreach ($temp as $item){
			$result['question'.$counter] = $item['question'];
			$result['answer'.$counter] = $item['answer'];
			$result['question_id'.$counter] = $item['question_id'];
			$result['private'.$counter] = $item['private'];
			$counter++;
		}
		
		$result['status'] = 1;*/
		$result = $temp->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($result);	
	
	}
	else{
		$counter = 0;
		$temp = $conn->prepare($sql2);	
		$temp->execute(array('id' => $category_id));
		/*foreach ($temp as $item){
			$result['question'.$counter] = $item['question'];
			$result['answer'.$counter] = $item['answer'];
			$result['question_id'.$counter] = $item['question_id'];
			$result['private'.$counter] = $item['private'];
			$counter++;
		}*/
		$result = $temp->fetchAll(PDO::FETCH_ASSOC);
		//$result['status'] = 1;
		echo json_encode($result);	
	}
}
else{
	$result['status'] = 0;
	$result['message'] = "no category selected";
	echo json_encode($result);	
}



?>