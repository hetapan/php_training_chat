<?php

/*------------------------------------------------
新規登録画面のバリデーションチェック
------------------------------------------------*/
class resisterError{
  private $nameError1 ="名前が未入力です"; //エラー：名前
  private $mailError1 ="メールアドレスが未入力です"; //エラー：アドレス
  private $mailError2 ="メールアドレスの形式が不正です"; //エラー：アドレス
  private $mailError3 ="メールアドレスが重複しています"; //エラー：アドレス
  private $passError1 ="パスワードが未入力です"; //エラー：パス
  private $passError2 ="パスワードは4文字以上,20文字以下の英数字で入力してください"; //エラー：パス

  private $nameFlag = 0;
  private $mailFlag = 0;
  private $passFlag = 0;

  private $resultFlag = 0;

//バリデーションチェック：名前
  public function getNameError($nameError){
    switch($nameError){
      case Null:
        $this->nameFlag = 1;
        return $this->nameError1;

      default:
      $this->nameFlag = 2;
    }
  }

//バリデーションチェック：メール
  public function getMailError($mailError){
    $pdo = new PDO('mysql:charset=UTF8;dbname=forum;host=localhost;', 'root', 'test');
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :mailError ");
    $stmt->bindValue(':mailError', $mailError);
    $stmt->execute();
    $data = $stmt->fetchAll();
    $count = count($data);
    unset($pdo);

    switch ($mailError) {
      case null:
        $this->mailFlag = 1;
        return $this->mailError1;

      case !filter_var($mailError, FILTER_VALIDATE_EMAIL):
        $this->mailFlag = 1;
        return $this->mailError2;

      case $count > 0 :
        $this->mailFlag = 1;
        return $this->mailError3;

      default:
        $this->mailFlag = 2;
    }
  }

//バリデーションチェック：パスワード
  public function getPassError($passError){
    switch($passError){
      case Null:
        $this->passFlag = 1;
        return $this->passError1;

      case !preg_match("/^[a-zA-Z0-9]{4,20}$/", $passError):
        $this->passFlag = 2;
        return $this->passError2;

      default:
      $this->passFlag = 2;
    }
  }

//エラー結果の取得⇒これを元に登録/登録完了画面の分岐を行う
  public function getResult(){
    if($this->nameFlag==2 && $this->mailFlag==2 && $this->passFlag==2){
      $this->resultFlag = 1;
      return $this->resultFlag;
    }
    return $this->resultFlag;
  }
}


?>