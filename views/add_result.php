<?php

session_start();

//ログインされていない場合は強制的にログインページにリダイレクト
if (!isset($_SESSION["username"])) {
  header("Location: top.php");
  exit();
}

//2重送信防止
$token = $_POST["token"];
$sessionToken = $_SESSION["token"];

unset($_SESSION["token"]);

//登録画面のform内容をデータベースthreadに追加する
if($token !="" && $token == $sessionToken){
  if(!empty($_POST['ttl'] && $_POST['txt'])){
    try{
      $pdo = new PDO('mysql:charset=UTF8;dbname=forum;host=localhost;', 'root', 'test');
      $stmt = $pdo->prepare('INSERT INTO thread(title, detail, user_id) VALUES (:title, :detail, :user_id)');
      $stmt->bindParam(':title', $_POST['ttl'], PDO::PARAM_STR);
      $stmt->bindParam(':detail', $_POST['txt'], PDO::PARAM_STR);
      $stmt->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT);
      $stmt->execute();
      unset($pdo);

      $result = "作成完了";

    } catch (PDOException $e){
      die('接続エラー：' .$e->getMessage());
    }

  } else {
    $result = "作成エラー<br>もう一度お試しください";
  }
} else {
  $result = "作成エラー<br>もう一度お試しください";
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>sample</title>
<link href="../public/css/default_style.css" rel="stylesheet" type="text/css" />
<link href="../public/css/add_result_style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php include('header.php'); ?>

<main>
  <div class="container">
    <div class="content">
      <P class="content__txt"><?php echo $result?></P>
      <a class="content__btn" href="threadlist.php" >スレッド一覧に戻る</a>
    </div>
  </div>
</main>
<footer></footer>


</body>
