<?php
header("Content-type: application/json; charset=utf-8");

//データベース接続
$server = "localhost";
$username =  "testuser";
$password = "root";
$dbname = "cloud_db";

$mysqli = new mysqli($server, $username, $password,$dbname);
if ($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
}else{
        $mysqli->set_charset("utf-8");
}

//受信
$Receive = file_get_contents('php://input');

if($Receive != null){
    //Jsonをデコード
    $obj = json_decode($Receive, true);

    //$objから取り出す
    /* Monster */
    $numMonster = $obj->numMonster;
    $currentHPMonster = $obj->currentHPMonster;
    $posXMonster = $obj->posXMonster;
    $posYMonster = $obj->posYMonster;
    $posZMonster = $obj->posZMonster;
    $direction = $obj->direction;
    /* User */
    $otherUserData = $obj->otherUserData;
    
    //更新（User）
	$sql = "UPDATE allUserCloud SET hp = '$hpUser',posX = '$posXUser',posY = '$posYUser', posZ = '$posZUser' WHERE id = '$idUser';";
    $mysqli -> query($sql);

    //更新（Monster）
	$sql = "UPDATE allMonsterCloud SET currentHP = '$currentHPMonster',posX = '$posXMonster',posY = '$posYMonster', posZ = '$posZMonster',direction = '$direction', userCount = '$userCount' WHERE num = '$numMonster';";
    $mysqli -> query($sql);
  

}

    //データベース接続解除
    $mysqli->close();

/* Monsterの移動命令計算
  
//JsonDataをJsonエンコード
$res=json_encode($array,JSON_UNESCAPED_UNICODE);

//$Sendに送信したいJsonデータを
$Send = $res;
//ヘッダ設定
$header = array(
	'Content-Type: application/json' //クライアントがWebサーバーに送信するコンテンツタイプ
);

//ストリームコンテキスト設定
$context = array(
	'http' => array(
		'ignore_errors' => true, //ステータスコードが失敗を意味する場合でもコンテンツを取得
		'method' => 'POST', //メソッド。デフォルトはGET
		'header' => implode("\r\n", $header), //ヘッダ設定
		'content' => $Send //送信したいデータ
	)
);

//$URLに送信URLを書き込む
$url = 'http://192.168.11.57/mec_user_';
$resentry = file_get_contents($url, false, stream_context_create($context));
}

*/

?>
