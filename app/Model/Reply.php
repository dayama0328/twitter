<?php

class Reply extends AppModel {
  public $belongsTo = array(
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'user_id'
    ),
    'Tweet' => array(
      'className' => 'Tweet',
      'foreignKey' => 'tweet_id'
    )
  );

  public function getData($tweetId, $userId) {
    $options = array(
      'conditions' => array(
        'Reply.tweet_id' => $tweetId,
        'Reply.user_id' => $userId
      )
    );
    return $this->find('first', $options);
  }
}

?>