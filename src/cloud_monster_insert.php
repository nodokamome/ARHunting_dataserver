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

$sql = "SELECT * FROM allMonsterCloud";
$result = $mysqli -> query($sql);
$row_cnt = $result->num_rows;

//クエリー失敗
if(!$result) {
  echo $mysqli->error;
  exit();
}

$num = $row_cnt + 1;
$name = $_POST['name'];
$power = $_POST['power'];
$defence = $_POST['defence'];
$initialHP = $_POST['initialHP'];
$popPlace = $_POST['popPlace'];
$monsterImage = $_POST['monsterImage'];


if($name != null || $popPlace != null || $power != null || $defence != null || $initialHP != null){
  $sql = "INSERT INTO allMonsterCloud(num,name,power,defence,initialHP,currentHP, popPlace, monsterImage) VALUES ('$num','$name','$power','$defence','$initialHP','$initialHP','$popPlace', '$monsterImage')";

$result = $mysqli -> query($sql);

echo "入力完了です";

}
else{
  echo "すべて入力してください";
}


//結果セットを解放
$result->free();
// データベース切断
$mysqli->close();
?>
