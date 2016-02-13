<?php

class UsersController extends AppController {

  public $uses = array('User', 'Tweet'); // 各モデルの呼び出し

  public $components = array(
    'Session',
    'Auth' => array(
      'authenticate' => array(
        'Form' => array(
          'fields' =>
            array('username' => 'email', 'password' => 'password')
        )
      ),
      'loginRedirect' => array('controller' => 'tweets', 'action' => 'index'),
      'logoutRedirect' => array('controller' => 'tweets', 'action' => 'index'),
      'authError' => 'メールアドレスとパスワードを入力してください'
    )
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('add');
  }

  public function add() { //新規会員登録
    if ($this->request->is('post')) {
      $this->User->set($this->data);

      if ($this->User->validates()) {
          // status => 0, regist_code => xxxxxxxxxxxxxxx を $this->data に入れる

          $this->User->save($this->data);


          $email = new CakeEmail( 'gmail');                        // インスタンス化
          $email->from( array( 'yamapoon24@gmail.com' => 'Sender'));  // 送信元
          $email->to( 'daiexile@yahoo.co.jp');                      // 送信先
          $email->subject( 'twitter課題テスト');                      // メールタイトル

          $email->send( 'ユーザー仮登録テスト');                             // メール送信

          // 新規会員登録されたら自動的にログイン状態にする
          $data = $this->User->find('first', array(
            'condition' => array('email' => $this->data['User']['email'])
          ));
          $this->Auth->login($data);
          $this->Session->setFlash('ログインに成功しました', 'default', array(), 'auth');

          return $this->redirect($this->Auth->redirect());
      }
    }
  }

  public function edit() {
    if ($this->request->is('post')) {
      $this->User->validate['email'] = array(
        'validEmail' => array(
          'rule' => array('email'),
          'message' => 'メールアドレスを入力してください'
        )
      );

      if ($this->User->validates()) {
        $this->User->save($this->data);

        //メールアドレス・パスワードを更新したら自動的にログイン状態にする
        $data = $this->User->find('first', array('conditions' => array('email' => $this->data['User']['email'])));
        $this->Auth->login($data['User']);
        $this->Session->setFlash('設定変更に成功しました', 'default', array(), 'auth');
        return $this->redirect($this->Auth->redirect());
      }
    }
  }

  public function login() {
    if ($this->request->is('post')) {
      $this->User->set($this->data); // Userテーブルに値をセット

      if ($this->Auth->login()) {
        return $this->redirect($this->Auth->redirect());
      } else {
        $this->Session->setFlash('メールアドレスかパスワードが間違っています', 'default', array(), 'auth');
      }
    }
  }

  public function logout() {
    $this->Auth->logout(); // ログアウト
    $this->Session->setFlash('ログアウトしました', 'default', array(), 'auth'); // エラーメッセージの表示
    return $this->redirect($this->Auth->redirect()); // リダイレクトさせる
  }
}

?>