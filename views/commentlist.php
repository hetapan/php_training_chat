<?php require_once('data.php') ?>
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


//コメントの一覧を取得
$commentId = $_GET['id'];
$commentsRes = Comment::findComment($comments, $commentId);

//コメント数を取得
$count = count($commentsRes);

//スレッド名を取得
$threadId = $_GET['id'];
$threadRes = Thread::findThread($threads, $threadId);

//スレッドのユーザーを取得
$userId = $_GET['userId'];
$userRes = User::findUser($users, $userId);

//コメントのNo.を変数に代入
$number = 1;

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>sample</title>
<link href="../public/css/default_style.css" rel="stylesheet" type="text/css" />
<link href="../public/css/commentlist_style.css" rel="stylesheet" type="text/css" />
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>

<?php include('header.php'); ?>
<main>
  <div class="container">
    <a class="back" href="threadlist.php">>>戻る</a>
    <div class="top">
      <h2 class="top__title"><?php echo $threadRes->getTitle() ?></h2>
      <p class="top__count">コメント数：<?php echo $count ?></p>
      <div class="top__content">
        <P class="top-content__name"><?php echo $userRes->getUsername() ?></P>
        <P class="top-content__time"><?php echo $threadRes->getCreated_at() ?></P>
        <P class="top-content__detail"><?php echo nl2br($threadRes->getDetail()) ?></P>
      </div>
    </div>
    <ul class="comments">
      <?php foreach ($commentsRes as $comment):?>
        <li class="comments__comment">
          <div class="comments-comment__top">
            <P class="comments-comment-top__number"><?php echo "No.".$number?></P>
            <P class="comments-comment-top__time"><?php echo $comment->getCreated_at() ?></P>
            <P class="comments-comment-top__name"><?php echo $comment->getuserName() ?></P>
          </div>
          <div class="comments-comment__bottom">
            <P class="comments-comment-bottom__txt"><?php echo nl2br($comment->getComment()) ?></P>
          </div>
        </li>
        <?php $number+=1 ?>
      <?php endforeach ?>
    </ul>
    <div class="new">
      <form action="comment_result.php" method="POST">
        <P class="new__ttl">新規コメント</P>
        <textarea class="new__txt" name="txt" maxlength="2000" rows="10" wrap="soft"></textarea>
        <input class="new__submit" type="submit" value="コメントを追加">
        <input type="hidden" name="commentId" value="<?php echo $commentId; ?>">
        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
        <input type="hidden" name="token" value="<?php echo $token;?>">
      </form>
    </div>
  </div>
</main>
<footer></footer>
</body>
