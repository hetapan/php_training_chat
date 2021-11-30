<?php

session_start();

//ログインされていない場合は強制的にログインページにリダイレクト
if (!isset($_SESSION["username"])) {
  header("Location: top.php");
  exit();
}

// 二重送信防止用トークンの発行
$token = uniqid('', true);;

//トークンをセッション変数にセット
$_SESSION['token'] = $token;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>sample</title>
<link href="../public/css/default_style.css" rel="stylesheet" type="text/css" />
<link href="../public/css/add_style.css" rel="stylesheet" type="text/css" />
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>

<!--hedaerの読み込み-->
<?php include('header.php'); ?>

<main>
  <div class="container">
    <div class="content">
      <form action="add_result.php" method="POST">
        <P class="content__memotxt">スレッドタイトル</P>
        <input class="content__tarea" type="text" name="ttl" maxlength="50">
        <P class="content__memotxt">内容</P>
        <textarea class="content__tarea2" name="txt" maxlength="2000" rows="20" wrap="soft"></textarea>
        <input class="content__submit" type="submit" value="スレッドを作成">
        <input type="hidden" name="token" value="<?php echo $token;?>">
      </form>
    </div>
  </div>
</main>
<footer></footer>


</body>
