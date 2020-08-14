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

$Receive = file_get_contents('php://input');

if($Receive != null){
	//JsonDataをデコードする
	$obj = json_decode($Receive);
    $idUser = $obj->idUser;
    $entryMonsterNum = $obj->entryMonsterNum;
    $userCount = $obj->userCount;

    //1人参加者を減らす
    $sql = "UPDATE allMonsterCloud SET userCount = '$userCount' WHERE num = '$entryMonsterNum';";
    $mysqli -> query($sql);

    //ユーザのモンスター情報を変更
    $sql = "UPDATE allUserCloud SET monsterNum = 0, entry = 0 WHERE id = '$idUser';";
    $mysqli -> query($sql);

}
// データベース切断
$mysqli->close();
?>