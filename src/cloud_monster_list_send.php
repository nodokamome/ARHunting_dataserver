<?php
header('Content-type: application/json; charset=UTF-8');

//データベース接続
$server = "localhost";
$username =  "testuser";
$password = "root";
$dbname = "cloud_db";

$mysqli = new mysqli($server, $username, $password,$dbname);
$mysqli->set_charset('utf8');
if ($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
}else{
        $mysqli->set_charset("utf-8");
}



//JsonDataを受け取る
$Receive = $_POST['MonsterList'];

if($Receive != null){
  //JsonDataをデコードする
  $obj = json_decode($Receive);

  //$objから取り出す
  $id = $obj->id;
  $hp = $obj->hp;
  
  $sql = "UPDATE allUserCloud SET hp = '$hp', monsterNum = 0, entry = 0 WHERE id = '$id'";
  $result = $mysqli -> query($sql);

  $sql = "SELECT * FROM allMonsterCloud ORDER BY num";
  $result = $mysqli -> query($sql);
  $row_cnt = $result->num_rows;
  
  for($i=1; $i <= $row_cnt; $i++){
      
      $sql = "SELECT * FROM allUserCloud where monsterNum = '$i'";
      $result = $mysqli -> query($sql);
      $userCount = $result->num_rows;
  
      $sql = "UPDATE allMonsterCloud SET userCount = '$userCount' WHERE num = '$i'";
      $mysqli -> query($sql);
  }

  $sql = "SELECT * FROM allMonsterCloud ORDER BY num";
  $result = $mysqli -> query($sql);
  $row_cnt = $result->num_rows;

  //データベース接続解除
  $mysqli->close();
  
  //配列を作成
  $num = [];
  $name = [];
  $initialHP = [];
  $currentHP = [];
  $power = [];
  $defence = [];
  $userCount = [];
  $popPlace = [];
  $monsterImage = [];

  //検索結果を追加
  while ($row = $result->fetch_assoc()){
    array_push($num, (int)$row['num']);
    array_push($name, $row['name']);
    array_push($initialHP, (int)$row['initialHP']);
    array_push($currentHP, (int)$row['currentHP']);
    array_push($power, (int)$row['power']);
    array_push($defence, (int)$row['defence']);
    array_push($userCount, (int)$row['userCount']);
    array_push($popPlace, $row['popPlace']);
    array_push($monsterImage, $row['monsterImage']);
  }
 
  //$resultを解放
  $result->free();
  //JsonDataを作成
  $array=array(
    'num'=>$num,
    'name'=>$name,
    'initialHP'=>$initialHP,
    'currentHP'=>$currentHP,
    'power'=>$power,
    'defence'=>$defence,
    'userCount'=>$userCount,
    'popPlace'=>$popPlace,
    'monsterImage'=>$monsterImage,
  );

  //JsonDataをJsonエンコード
  $res=json_encode($array,JSON_UNESCAPED_UNICODE);
  echo $res;
}
?>
