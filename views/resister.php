<?php require_once('data.php'); ?>
<?php

session_start();

// ログイン状態の場合ログイン後のページにリダイレクト
if (isset($_SESSION["username"])) {
  session_regenerate_id(TRUE);
  header("Location: threadlist.php");
  exit();
}

//エラーの初期化
$nameError = "";
$mailError = "";
$passError = "";

//エラーの取得
if(!empty($_POST)){
  $nameError = $resisterError->getNameError($_POST['username']);
  $mailError = $resisterError->getMailError($_POST['email']);
  $passError = $resisterError->getPassError($_POST['password']);
}

//登録画面のform内容をデータベースthreadに追加する
if ($resisterError->getResult() == 1) {
  if(!empty($_POST['username'] && $_POST['email'] && $_POST['password'])){
    try{
      $pdo = new PDO('mysql:charset=UTF8;dbname=forum;host=localhost;', 'root', 'test');
      $stmt = $pdo->prepare('INSERT INTO users(username, email, password) VALUES (:username, :email, :password)');
      $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
      $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $stmt->bindParam(':password', $password, PDO::PARAM_STR);
      $stmt->execute();

      $id = $pdo->lastInsertId(); //セッションID保持要

      unset($pdo);

    } catch (PDOException $e){
      var_dump(('接続エラー：' .$e->getMessage()));
    }

    session_regenerate_id(true); //session_idを新しく生成し、置き換える
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['id'] = $id;

  }
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>sample</title>
<link href="../public/css/default_style.css" rel="stylesheet" type="text/css" />
<link href="../public/css/resister_style.css" rel="stylesheet" type="text/css" />
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>

<header>
  <div class="container">
    <div class="header__left">
      <P class="header-left__txt">掲示板</P>
    </div>
    <ul class="header__right">
    </ul>
  </div>
</header>

<main>
  <div class="container">
    <div class="content">
      <form action="resister.php" method="post">
        <!-- 初期/エラー時の画面 -->
        <?php if( $resisterError->getResult() == 0): ?>
          <P class="content__txt">ユーザー名</P>
          <p class="content__error"><?php echo $nameError ?></p>
          <input class="content__tarea" type="text" name="username" maxlength="20">
          <P class="content__txt">アドレス</P>
          <p p class="content__error"><?php echo $mailError ?></p>
          <input class="content__tarea" type="text" name="email" maxlength="50">
          <P class="content__txt">パスワード</P>
          <p p class="content__error"><?php echo $passError ?></p>
          <input class="content__tarea" type="password" name="password" maxlength="10">
          <input class="content__submit" type="submit" value="新規登録">
        <!-- 登録完了時の画面 -->
        <?php elseif( $resisterError->getResult() == 1): ?>
          <P class="content__txt2">作成完了！</P>
          <a class="content__btn" href="threadlist.php" >スレッド一覧に進む</a>
        <?php endif ?>
      </form>
    </div>
  </div>
</main>
<footer></footer>

</body>
