<?php

session_start();



//ログインされていない場合は強制的にログインページにリダイレクト
if (!isset($_SESSION["username"])) {
  header("Location: top.php");
  exit();
}

//セッション変数をクリア
$_SESSION = array();

//クッキーに登録されているセッションidの情報を削除
if (ini_get("session.use_cookies")) {
  setcookie(session_name(), '', time() - 42000, '/');
}

//セッションを破棄
session_destroy();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>sample</title>
<link href="../public/css/default_style.css" rel="stylesheet" type="text/css" />
<link href="../public/css/logout_style.css" rel="stylesheet" type="text/css" />
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
      <P class="content__txt">ログアウトしました</P>
      <a class="content__btn" href="top.php" >トップページに戻る</a>
    </div>
  </div>
</main>
<footer></footer>


</body>
