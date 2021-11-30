<?php

session_start();

// ログイン状態の場合ログイン後のページにリダイレクト
if (isset($_SESSION["username"])) {
  session_regenerate_id(TRUE);
  header("Location: threadlist.php");
  exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>sample</title>
<link href="../public/css/default_style.css" rel="stylesheet" type="text/css" />
<link href="../public/css/top_style.css" rel="stylesheet" type="text/css" />
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
    <div class="mainbox">
      <a class="mainbox__resister" href="resister.php">新規登録</a>
      <a class="mainbox__login" href="login.php" >ログイン</a>
    </div>
  </div>
</main>
<footer></footer>

</body>
