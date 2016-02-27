<?php

class User extends AppModel {
  public $validate = array(
    'acountname' => array(
      'rule' => 'notBlank'
    ),

    'username' => array(
      'rule' => 'notBlank'
    ),

    'email' => array(
      'validEmail' => array(
        'rule' => array('email'),
        'message' => 'メールアドレスを入力してください'
      ),

      'emailExists' => array(
        'rule' => array('isUnique', array('email')),
        'message' => '既に登録済みです'
      )
    ),

    'password' => array(
      'match' => array(
        'rule' => array(
          'confPassword', 'passwordconf' // confPassword(関数名)の呼び出し
        ),
        'message' => 'パスワードが一致しません'
      )
    )
  );

  public function confPassword($field,$colum) { // $columはどこから出てきたのか
    var_dump($field['password']);
    var_dump($this->data['User'][$colum]);
    if ($field['password'] === $this->data['User'][$colum]) { // $field['password'] = password, $this->data['User'][$colum] = passwordconf
      $this->data['User']['password'] = Authcomponent::password($field['password']);
      return true;
    }
  }

  public function oldPassword($field, $colum) { // $field = usersテーブルのpassword, $colum = passwordold
    $passwordold = Authcomponent::password($field[$colum]); // $passwordoldの暗号化
    $row = $this->findById($this->data['User']['id']);// usersテーブルのidを$rowに格納

    if ($passwordold === $row['User']['password']) { // $passwordoldとusersテーブルのpasswordを照合
        return true;
    }
  }
}

?>