<?php

class Comment {
  private $id;
  private $comment;
  private $user_id;
  private $thread_id;
  private $created_at;
  private $updated_at;
  private $userName;

  public function __construct($id, $comment, $user_id, $thread_id, $created_at, $updated_at, $userName){
    $this->id = $id;
    $this->comment = $comment;
    $this->user_id = $user_id;
    $this->thread_id = $thread_id;
    $this->created_at = $created_at;
    $this->updated_at = $updated_at;
    $this->userName = $userName;
  }

  public function getId(){
    return $this->id;
  }

  public function getComment(){
    return $this->comment;
  }

  public function getUser_id(){
    return $this->user_id;
  }

  public function getThread_id(){
    return $this->thread_id;
  }

  public function getCreated_at(){
    return $this->created_at;
  }

  public function getUpdated_at(){
    return $this->updated_at;
  }

  public function getuserName(){
    return $this->userName;
  }

  public static function findComment($comments, $commentId){
    $commentsRes = array(); //配列宣言をすることで、foreachの結果が空でもエラーがでない
    foreach($comments as $comment){
      if($comment->thread_id == $commentId){
        $commentsRes[] = $comment;
      }
    }
    return $commentsRes;
  }


}




?>