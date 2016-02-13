<?php

class Tweet extends AppModel {
  public $validate = array(
    'content' => array(
      'maxLength' => array(
        'rule' => array('maxLength', '140'),
        'required' => true,
        'message' => 'タイトルは140文字以内で入力してください',
        'style' => 'color:red;'
      ),
    )
  );

  public $belongsTo = array(
    'User' => array(
    'className' => 'User',
    'foreignKey' => 'user_id'
    )
  );

  public $hasMany = array(
    'Reply' => array(
    'className' => 'Reply',
    'foreignKey' => 'tweet_id',
    'dependent' => false
    )
  );
}

?>