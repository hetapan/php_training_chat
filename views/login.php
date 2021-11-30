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
$error = "";

//ログインするためにDBに接続
if(!empty($_POST)){
  $email = $_POST['email'];
  $pass = $_POST['pass'];

  try{
  $pdo = new PDO('mysql:charset=UTF8;dbname=forum;host=localhost;', 'root', 'test');
  $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
  $stmt->bindvalue(':email', $email);
  $stmt->execute();
  $row = $stmt->fetch();
  unset($pdo);

  } catch (PDOException $e){
    die('接続エラー：' .$e->getMessage());
  }

  //メールアドレスを検索
  if (!isset($row['email'])) {
    $error = 'メールアドレス<br>又はパスワードが間違っています。';

  //パスワード確認
  }elseif(!password_verify($pass, $row['password'])){
    $error = 'メールアドレス<br>又はパスワードが間違っています。';

  //メールアドレスとパスワードが一致した場合はログイン処理を行う
  }else{
    session_regenerate_id(true); //session_idを新しく生成し、置き換える
    $_SESSION['username'] = $row['username'];
    $_SESSION['id'] = $row['id'];

    $login_success_url = "threadlist.php";
    header("Location: {$login_success_url}");
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
<link href="../public/css/login_style.css" rel="stylesheet" type="text/css" />
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
      <form action="" method="post">
        <p class="content__error"><?php echo $error ?></p>
        <P class="content__memotxt">ログインID</P>
        <input class="content__tarea" type="text" name="email" maxlength="20">
        <P class="content__memotxt">パスワード</P>
        <input class="content__tarea" type="password" name="pass" maxlength="20">
        <input class="content__submit" type="submit" value="ログイン">
      </form>
    </div>
  </div>
</main>
<footer></footer>

</body>
