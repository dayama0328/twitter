<?php

class RepliesController extends AppController {

  public function reply ($tweetId = null, $userId = null) {
        $this->Reply->id = $tweetId;
        $this->set('post', $this->Reply->findById($tweetId));


    if ($this->request->is('post')) {
      $request = $this->request->data['Reply'];

      $data = array(
        'user_id' => $this->user['id'],
        'tweet_id' => $request['tweet_id'],
        'acountname' => $this->user['acountname'],
        'username' => $this->user['username'],
        'content' => $request['content']
      );
      //var_dump($data);
      $this->Reply->save($data);

    }

    $reply = $this->Reply->getData($tweetId, $this->user['id']);
    $id = !empty($reply['Reply']['id']) ? $reply['Reply']['id'] : 0;
    $content = !empty($reply['Reply']['content']) ? $reply['Reply']['content'] : '';

    $this->set('id', $id);
    $this->set('content', $content);
    $this->set('tweetId', $tweetId);
    //$this->render('/Tweets/reply.ctp');
    $this->redirect( array('controller' => 'tweets', 'action' => 'reply', $request['tweet_id']));
  }
}

?>