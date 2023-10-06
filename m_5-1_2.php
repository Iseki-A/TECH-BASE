<?php
//DB接続設定
$dsn = 'mysql:dbname=XXXDB;host=localhost';
$user = 'XXXUSER';
$password = 'XXXPASSWORD';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));



//テーブルの表示
$sql ='SHOW TABLES';
    $result = $pdo -> query($sql);
    foreach ($result as $row){
        echo $row[0];
        echo '<br>';
    }
    echo "<hr>";

//テーブルの構成確認
    $sql ='SHOW CREATE TABLE m_5';
    $result = $pdo -> query($sql);
    foreach ($result as $row){
        echo $row[1];
    }
    echo "<hr>";
  
    


    //データベースに投稿内容を表示
    $sql = 'SELECT * FROM m_5';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].'<>';
        echo $row['name'].'<>';
        echo $row['comment'].'<>';
        echo $row['datetime'].'<>';
        echo $row['password'].'<br>';
        echo "<hr>";
    }
    
?>

       
</body>
</head>