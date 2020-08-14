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
$regist= $_POST['regist'];

if($regist != null){
	//JsonDataをデコードする
	$obj = json_decode($regist);

	$id = $obj->id;
    $name = $obj->name;
	$sql = "INSERT INTO allUserCloud(id,name) VALUES('$id','$name');";
	$result = $mysqli -> query($sql);
	$array=array(
		'id'=>"$id",
        'name'=>"$name",
	);

	//jsonを作成して、エンコード
	$res=json_encode($array,JSON_UNESCAPED_UNICODE);
	echo $res;

}

//JsonDataを受け取る
$start = $_POST['start'];

if($start != null){
	//JsonDataをデコードする
	$obj = json_decode($start);
	$id = $obj->id;

	$sql = "SELECT * FROM allUserCloud WHERE id = '$id'";
	$result = $mysqli -> query($sql);

	$row = $result->fetch_assoc();
	$name = $row['name'];

	$array=array(
		'name'=>"$name",
	);

	//jsonを作成して、エンコード
	$res=json_encode($array,JSON_UNESCAPED_UNICODE);
	echo $res;

}
// データベース切断
$mysqli->close();
?>
