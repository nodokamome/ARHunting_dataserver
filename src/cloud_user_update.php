<?php

//データベース接続
$server = "localhost";
$username =  "testuser";
$password = "root";
$dbname = "cloud_db";

//データベース接続
$mysqli = new mysqli($server, $username, $password,$dbname);
if ($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
}else{
  $mysqli->set_charset("utf-8");
}

//JsonDataを受け取る
$Receive = $_POST['update'];

if($Receive != null){
	//JsonDataをデコードする
	$obj = json_decode($Receive);
	$id = $obj->id;
	$name = $obj->name;
	$sql = "UPDATE allUserCloud SET name = '$name' WHERE id = '$id';";
	$result = $mysqli -> query($sql);
}

// データベース切断
$mysqli->close();
?>
