<?php require_once('data.php') ?>
<?php

session_start();

if(!isset($_SESSION["username"])) {
  header("Location: top.php");
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
<link href="../public/css/threadlist_style.css" rel="stylesheet" type="text/css" />
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>

<?php include('header.php'); ?>
<main>
  <div class="container">
    <a class="addmemo" href="add.php" >新しいスレッドを作成</a>
    <ul class="memos">
      <?php foreach($threads as $thread):?>
        <li class="memos__memo">
          <div class="memos-memo__left">
            <a class="memos-memo-left__ttl" href="commentlist.php?id=<?php echo $thread->getId() ?> & userId=<?php echo $thread->getUser_id()?>"><?php echo $thread->getTitle() ?></a>
            <p class="memos-memo-left__txt"><?php echo $thread->getDetail() ?></p>
          </div>
        </li>
      <?php endforeach ?>
    </ul>
  </div>
</main>
<footer></footer>
</body>
