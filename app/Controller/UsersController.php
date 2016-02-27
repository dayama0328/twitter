<?php
App::uses('CakeEmail', 'Network/Email');
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
    $this->Auth->allow('add', 'sendmailcomplete', 'registcomplete');
  }

  public function add() { //新規会員登録
    if ($this->request->is('post')) {
      $this->User->set($this->data);

      if ($this->User->validates()) {
          // status => 0, regist_code => xxxxxxxxxxxxxxx を $this->data に入れる

          $uuid = md5(uniqid());

          $data = $this->data;
          $data['User']['regist_code'] = $uuid;

          $this->User->save($data);

          $email = new CakeEmail( 'gmail');                           // インスタンス化
          $email->from( array( 'daiexile@yahoo.co.jp' => 'Sender'));  // 送信元
          $email->to('yamapoon24@gmail.com');                         // 送信先
          $email->subject('twitter課題テスト');                       // メールタイトル
          $email->emailFormat( 'html');                         // フォーマット
          $email->template( 'mailsendtest');                           // テンプレートファイル
          $email->viewVars( array('registurl' => 'http://dev.elites.com/elites/twitter/users/registcomplete/', 'regist_code' => $uuid));
          $email->send('');                       // メール送信

          $this->redirect( array('contoller' => 'users', 'action' => 'sendmailcomplete'));

      }
    }
  }

  public function sendmailcomplete() {
    $this->Session->setFlash('仮登録が完了いたしました。指定のメールアドレスをご確認ください。', 'default', array(), 'auth');
  }

  public function registcomplete($regist_code = null) {

    $data = $this->User->find('first', array(
      'conditions' => array('regist_code' => $regist_code)
    ));

    $data['User']['status'] = 1;
    $this->User->save($data, false);

    $this->Session->setFlash('本登録が完了いたしました', 'default', array(), 'auth');
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
