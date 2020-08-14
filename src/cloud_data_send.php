<?php

function postJson($url, $data){
  
  return $result;
}

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
$Receive = $_POST['DL'];

if($Receive != null){
	//JsonDataをデコードする
$obj = json_decode($Receive);
  $idUser = $obj->id;
  $entryMonsterNum = (int)$obj->entryMonsterNum;


  $sql = "UPDATE allMonsterCloud SET userCount = userCount+1 WHERE num = '$entryMonsterNum'";
  $mysqli -> query($sql);

  $sql = "UPDATE allUserCloud SET monsterNum = '$entryMonsterNum', entry = 1 WHERE id = '$idUser'";
  $mysqli -> query($sql);



  //ここからDLの処理

  $sql = "SELECT * FROM allMonsterCloud WHERE num = '$entryMonsterNum'";
  $result = $mysqli -> query($sql);

  $row = $result->fetch_assoc();

  $monsterName = $row['name'];
  $currentHPMonster = (int)$row['currentHP'];
  $initialHPMonster = (int)$row['initialHP'];
  $power = (int)$row['power'];
  $defence = (int)$row['defence'];
  $posXMonster = $row['posX'];
  $posYMonster = $row['posY'];
  $posZMonster = $row['posZ'];
  $action = $row['action'];
  $userCount = (int)$row['userCount'];

  //$resultを解放
  $result->free();

  //JsonDataを作成
  $array=array(
    //monsterのデータ
    'monsterName'=>$monsterName,
    'power'=>$power,
    'defence'=>$defence,
    'initialHPMonster'=>$initialHPMonster,
    'currentHPMonster'=>$currentHPMonster,
    );

  //JsonDataをJsonエンコード
  $res=json_encode($array,JSON_UNESCAPED_UNICODE);
  echo $res;



  /* MECへ送信する */
  $array=array(
    //monsterのデータ
    'num'=>$entryMonsterNum,
    'name'=>$monsterName,
    'power'=>$power,
    'defence'=>$defence,
    'posXMonster'=>$posXMonster,
    'posYMonster'=>$posYMonster,
    'posZMonster'=>$posZMonster,
    'action'=>$action,
    'userCount'=>$userCount,
    'currentHP'=>$currentHPMonster,
    'initialHP'=>$initialHPMonster,
    );


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

require('mec_ipaddress.php');
$url = $mec_ipaddress.":3000";
//$URLに送信URLを書き込む
//$url = 'http://192.168.43.72:3000';
file_get_contents($url, false, stream_context_create($context));
/*
  $data=json_encode($array,JSON_UNESCAPED_UNICODE);
  //$URLに送信URLを書き込む
 
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result=curl_exec($ch);
  curl_close($ch);*/
}


$result->free();
$mysqli->close();
?>
