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

$sql = "SELECT * FROM allMonsterCloud order by num";
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
<title>cloud_monster_insert_form.php</title>
</head>
<body>
<h3>モンスターの登録フォーム</h3><a href="cloud_monster_list.php">cloud_monster_list.phpへ</a>
  <hr>
  <h3>入力してください</h3>
  <form action="cloud_monster_insert.php" method="POST">
   モンスターの名前：
   <input type="text" name="name">(全角8文字まで)<br>
   攻撃力：
   <input type="text" name="power"><br>
   防御力：
   <input type="text" name="defence"><br>
   HP：
   <input type="text" name="initialHP"><br>
   出現場所：
   <input type="text" name="popPlace">(全角5文字まで）<br>
   ファイル名：
   <input type="text" name="monsterImage">(全て小文字、pngファイル）<br>
    
   <Input type="submit" value="送信" style="width:60px;margin-left:300px"><br>　
  </form>
   <hr>
  <h3>一覧</h3>
  <table border="1">
    <tr>
    <th>num<br>（No.）</th>
    <th>name<font><br>（名前）</font></th>
    <th>power<br>（攻撃力）</th>
    <th>defence<br>（防御力）</th>
    <th>posX<br>（X座標）</th>
    <th>posY<br>（Y座標）</th>
    <th>posZ<br>（Z座標）</th>
    <th>action<br>（action)）</th>
    <th>initialHP<br>（初期HP）</th>
    <th>currentHP<br>（現在HP）</th>
    <th>userCount<br>（参加人数）</th>
    <th>popPlace<br>（出現場所）</th> 
    <th>monsterImage<br>（モンスターの画像）</th>
    <th>delete<br>（削除）</th>
    </tr>

  <?php
  foreach($rows as $row){
  ?>
	<tr>
    <td><?php echo $row['num']; ?></td>
    <td><?php echo htmlspecialchars($row['name'],ENT_QUOTES,'UTF-8'); ?></td>
    <td><?php echo $row['power']; ?></td>
    <td><?php echo $row['defence']; ?></td>
    <td><?php echo htmlspecialchars($row['posX'],ENT_QUOTES,'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($row['posY'],ENT_QUOTES,'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($row['posZ'],ENT_QUOTES,'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($row['action'],ENT_QUOTES,'UTF-8'); ?></td>
    <td><?php echo $row['initialHP']; ?></td>
    <td><?php echo $row['currentHP']; ?></td>
    <td><?php echo $row['userCount']; ?></td>
    <td><?php echo htmlspecialchars($row['popPlace'],ENT_QUOTES,'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($row['monsterImage'],ENT_QUOTES,'UTF-8'); ?></td>
    <td><form action="cloud_monster_delete.php" method = "post" >
      <input type ="submit"  value="削除">
      <input type = "hidden" name="delete" value="<?=$row['num']?>">
    </form></td>
  </tr>

  <?php
  }
  ?>

  </table>
  </body>
  </html>
