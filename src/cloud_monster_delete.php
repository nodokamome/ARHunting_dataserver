<?php
header('Location: cloud_monster_insert_form.php');

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


$Receive = $mysqli->real_escape_string($_POST['delete']);

if($Receive != null){
	   $sql = "DELETE from allMonsterCloud where num = '$Receive'";
	   $result = $mysqli -> query($sql);
}

//結果セットを解放
$result->free();
// データベース切断
$mysqli->close();
?>
