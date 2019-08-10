<?php header('Content-Type:application/json');

if(isset($_POST['token'])){
	$token = $_POST['token'];
}
else{
	$token = 0;
}
//category id
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "mydb";
$result = array();
$counter = 0;
$auth = false;
$conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
$sql1 = "SELECT name,category_id FROM category WHERE private = 0 ";
$sql2 = "SELECT name,category_id FROM category";
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
$temp->execute();
$result = $temp->fetchAll(PDO::FETCH_ASSOC);
//$result['status'] = 1;

if($auth){
	$temp = $conn->prepare($sql2);
	$temp->execute();
	$result = $temp->fetchAll(PDO::FETCH_ASSOC);
}
echo json_encode($result);
	



//echo json_encode($result);


?>