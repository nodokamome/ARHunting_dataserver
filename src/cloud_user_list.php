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

$sql = "SELECT * FROM allUserCloud";
$result = $mysqli -> query($sql);

//クエリー失敗
if(!$result) {
        echo $mysqli->error;
        exit();
}
//連想配列で取得
while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $rows[] = $row;
}
$result->free();
$mysqli->close();
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
    <meta http-equiv="refresh" content="0.5; URL=">
<title>cloud_user_list.php</title>
</head>
<body>
  <h3>全ての登録ユーザ</h3>
  <hr>
   <h3>一覧（DB：allUserCloud）</h3>
  <table border="1">
    <tr>
    <th>id<br>（ユーザid）</th>
    <th>name<br>（名前）</th>
    <th>hp<br>（体力）</th>
    <th>posX<br>（X座標）</th>
    <th>posY<br>（Y座標）</th>
    <th>posZ<br>（Z座標）</th>
    <th>monsterNum<br>（モンスターNo.）</th>
    <th>entry<br>（参加の有無）</th>
    <th>delete<br>（削除）</th>
    </tr>

  <?php
  foreach($rows as $row){
        ?>
  <tr>
  <td><?php echo $row['id']; ?></td>
  <td><?php echo htmlspecialchars($row['name'],ENT_QUOTES,'UTF-8'); ?></td>
  <td><?php echo $row['hp']; ?></td>
  <td><?php echo htmlspecialchars($row['posX'],ENT_QUOTES,'UTF-8'); ?></td>
  <td><?php echo htmlspecialchars($row['posY'],ENT_QUOTES,'UTF-8'); ?></td>
  <td><?php echo htmlspecialchars($row['posZ'],ENT_QUOTES,'UTF-8'); ?></td>
  <td><?php echo $row['monsterNum']; ?></td>
  <td><?php echo $row['entry']; ?></td>
  <td><form action="cloud_user_delete.php" method = "post" >
          <input type ="submit"  value="削除">
          <input type = "hidden" name="delete" value="<?=$row['id']?>">
          </form></td>
  </tr>
  <?php
  }
  ?>
</table>
</body>
</html>
