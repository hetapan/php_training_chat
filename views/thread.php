<?php

class Thread {
  private $id;
  private $title;
  private $detail;
  private $created_at;
  private $updated_at;
  private $user_id;

  public function __construct($id, $title, $detail, $user_id, $created_at, $updated_at){
    $this->id = $id;
    $this->title = $title;
    $this->detail = $detail;
    $this->user_id = $user_id;
    $this->created_at = $created_at;
    $this->updated_at = $updated_at;
  }

  public function getId(){
    return $this->id;
  }

  public function getTitle(){
    return $this->title;
  }

  public function getDetail(){
    return $this->detail;
  }

  public function getUser_id(){
    return $this->user_id;
  }

  public function getCreated_at(){
    return $this->created_at;
  }

  public function getUpdated_at(){
    return $this->updated_at;
  }

  public static function findThread($threads, $threadId){
    foreach($threads as $thread){
      if($thread->id == $threadId){
        return $thread;
      }
    }
  }

}



?>