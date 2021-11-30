<?php
require_once('thread.php');
require_once('Comment.php');
require_once('user.php');
require_once('errorlist.php');

/*------------------------------------------------
Threadクラスのインスタンス生成
------------------------------------------------*/

//データベースthredに接続してスレッドの一覧を取得
$pdo = new PDO('mysql:charset=UTF8;dbname=forum;host=localhost;', 'root', 'test');
$stmt = $pdo->prepare("SELECT * FROM thread");
$stmt->execute();
$data = $stmt->fetchAll();
unset($pdo);

//取得したデータを元にThreadクラスのインスタンスを生成
foreach($data as $row){
  $threads[] = new Thread($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
}

/*------------------------------------------------
Commentクラスのインスタンス生成
------------------------------------------------*/
//データベースthredに接続してスレッドの一覧を取得
$pdo = new PDO('mysql:charset=UTF8;dbname=forum;host=localhost;', 'root', 'test');
$stmt = $pdo->prepare("SELECT * FROM comment INNER JOIN users ON comment.user_id = users.id");
$stmt->execute();
$data = $stmt->fetchAll();
unset($pdo);

//取得したデータを元にThreadクラスのインスタンスを生成
foreach($data as $row){
  $comments[] = new Comment($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[7]);
}

/*------------------------------------------------
Userクラスのインスタンス生成
------------------------------------------------*/

//データベースUserに接続してスレッドの一覧を取得
$pdo = new PDO('mysql:charset=UTF8;dbname=forum;host=localhost;', 'root', 'test');
$stmt = $pdo->prepare("SELECT * FROM users");
$stmt->execute();
$data = $stmt->fetchAll();
unset($pdo);

//取得したデータを元にUserクラスのインスタンスを生成
foreach($data as $row){
  $users[] = new User($row[0], $row[1], $row[2], $row[3]);
}

/*------------------------------------------------
resisterErrorクラスのインスタンス生成
------------------------------------------------*/
$resisterError = new resisterError();


?>