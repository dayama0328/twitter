<?php

class TweetsController extends AppController {

  public $uses = array('Tweet', 'User', 'Reply'); // 各モデルの呼び出し

  public function beforeFilter() {
    parent::beforeFilter();
  }

  public function index() { // ツイート一覧ページ
    $this->set('list', $this->Tweet->find('all'));
    $user = $this->Auth->user();
  }

  public function add() {// 新規ツイート
    if ($this->request->is('post')) {
      $request = $this->request->data['Tweet']; // $requestにそのデータを格納
      $user = $this->Auth->user();

      $this->Tweet->set($this->data); //postされたら値をセット

      if ($this->Tweet->validates()) {

        $data = array( //データベースに保存するカラムと値を格納
        'user_id' => $user['id'],
        'acountname' => $user['acountname'],
        'username' => $user['username'],
        'content' => $request['content']
        );

        $this->Tweet->save($data); //tweetsテーブルに値を格納
        $this->redirect('index');
      }
    }
  }

  public function edit($id = null) {
        $this->Tweet->id = $id;
        $post = $this->Tweet->findById($id);

        if ($this->request->is('get')) {
            $this->request->data = $post;
        }

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Tweet->save($this->request->data)) {
                //$this->Session->setFlash('Updated!');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Failed...');
            }
        }
  }

  public function reply($id = null) {
        $user = $this->Auth->user();
        $this->Tweet->id = $id;
        $this->set('post', $this->Tweet->findById($id));
        $this->set('reply', $this->Reply->findAllByTweetId($id));
        //var_dump($this->Reply->findAllByTweetId($id));
  }

  public function delete($id = null) {
    if ($this->request->is('post')) {
          $request = $this->request->data['Tweet'];
          $data = array(
              'content' => $request['content']
          );
          $this->Tweet->delete($request['id']); // idと合致するもののデータを削除する
          $this->redirect('index'); // indexにリダイレクトさせる
    } else {
        $data = $this->Tweet->findById($id);
    }
    $this->set('data', $data['Tweet']);
  }
}


?>