<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>mission_5</title>
</head>
<body>
<?php
//DB接続設定
$dsn = 'mysql:dbname=XXXDB;host=localhost';
$user = 'XXXUSER';
$password = 'XXXPASSWORD';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


//新規投稿
if(!empty($_POST['送信']) && (empty($_POST['exnum']))){
$datetime = date("Y/m/d H:i:s");   
$sql = "INSERT INTO m_5 (name, comment, datetime, password) VALUES (:name, :comment, :datetime, :password)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
$stmt->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
$stmt->bindParam(':datetime', $datetime, PDO::PARAM_STR);
$stmt->bindParam(':password', $_POST['password'], PDO::PARAM_STR);
$stmt->execute();
}


//削除機能
if(!empty($_POST['number'])){ 
    $id=$_POST['number'];  
    $pw2=$_POST['pw2'];  
    $sql='delete from m_5 where id=:id AND password=:pw2'; 
    $stmt=$pdo->prepare($sql); 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->bindParam(':pw2', $pw2, PDO::PARAM_STR); 
    $stmt->execute(); 
} 


//編集機能
if(!empty($_POST['exnum'])){
    $id = $_POST['exnum'];
    $name = $_POST['name'];
    $comment = $_POST['comment']; 
    $datetime = date("Y/m/d H:i:s");
    $password = $_POST['password'];
    $sql = 'UPDATE m_5 SET name=:name, comment=:comment, datetime=:datetime, password=:password WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':datetime', $datetime, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();  
} 


//編集データ取得
if(!empty($_POST["number2"])){
    $editnum=$_POST['number2'];
    $pw3=$_POST['pw3'];
    $sql = 'SELECT * FROM m_5 WHERE id=:editnum AND password=:pw3';
    $stmt=$pdo->prepare($sql); 
    $stmt->bindParam(':editnum',$editnum, PDO::PARAM_INT); 
    $stmt->bindParam(':pw3', $pw3, PDO::PARAM_STR);             $stmt->execute(); 
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        $exnum=$row['id'];
        $exname=$row['name'];
        $excontents=$row['comment'];
        $expw=$row['password'];
    }
}
?>



<span style="font-size: 20px;">掲示板テーマ：やったことがある or やってみたいバイト<br></span>


<!--投稿フォーム-->
<form action="" method="post">
     名前<br> <input type="name" name="name"value="<?php if(!empty($exname)) {echo $exname;} ?>" placeholder="ここに入力して下さい"><br>
     コメント<br><input type="text" name="comment"value="<?php if(!empty($excontents)) {echo $excontents;} ?>" placeholder="ここに入力して下さい"><br>
     パスワード<br><input type="text" name="password" value="<?php if(!empty($expw)) {echo $expw;} ?>" placeholder="ここに入力して下さい"><br>
     <input type="hidden" name="exnum" value="<?php if(!empty($exnum)) {echo $exnum;} ?>" placeholder="編集番号表示">
      <input type="submit" name="送信" value="送信"><br><br>
      削除用<br><input type="number" name="number" value=""placeholder="数字を入力して下さい"><br>
      パスワード<br><input type="text" name="pw2" value=""placeholder="ここに入力して下さい"><br>
      <input type="submit" name="削除" value="削除"><br><br>
       編集対象番号<br><input type="number" name="number2" value=""placeholder="数字を入力して下さい"><br>
       パスワード<br><input type="text" name="pw3" value=""placeholder="ここに入力して下さい"><br>
      <input type="submit" name="編集" value="編集"><br><br>
       </form>


<?php
//ブラウザ表示機能
$sql='SELECT*FROM m_5'; 
 $stmt=$pdo->query($sql); 
 $results=$stmt->fetchAll(); 
 foreach($results as $row){ 
     echo $row['id'].' '; 
     echo $row['name'].' '; 
     echo $row['comment'].' '; 
     echo $row['datetime'].'<br>'; 
 } 
  ?> 
</body>