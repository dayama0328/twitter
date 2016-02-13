<h3>ログイン</h3>
  <?=$this->Session->flash('auth')?>
  <?=$this->Form->create('User', array('aciton' => 'login')); ?>
  <?=$this->Form->input('email', array('label' => 'メールアドレス', 'type' => 'email')); ?>
  <?=$this->Form->input('password', array('label' => 'パスワード', 'type' => 'password')); ?>
  <?=$this->Form->end('ログイン'); ?>