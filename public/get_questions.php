<?php

if(isset($_GET['userid'])){
	$userid = $_GET['userid'];
}
else{
	$userid = 0;
}



$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "mydb";
//returns private and public questions for param userid
if(isset($userid)){
	$result = array();
	$counter = 0;
	$conn = new PDO("mysql:host=$dbservername;dbname=myDB", $dbusername, $dbpassword);
	$sql1 = "SELECT question,answer,category,private FROM qa WHERE private = 1 AND userid ='".$userid."'";
	$sql2 = "SELECT question,answer,category,private FROM qa WHERE private = 0";
	foreach ($conn->query($sql1) as $item){
		$result['question'.$counter] = $item['question'];
		$result['answer'.$counter] = $item['answer'];
		$result['category'.$counter] = $item['category'];
		$result['private'] = $item['private'];
		$counter++;
	}
	foreach ($conn->query($sql2) as $item){
		$result['question'.$counter] = $item['question'];
		$result['answer'.$counter] = $item['answer'];
		$result['category'.$counter] = $item['category'];
		$result['private'.$counter] = $item['private'];
		$counter++;
	}
	$result[$counter] = $counter;
	echo json_encode($result);	
	
}
else{
	echo 0;
}


?>