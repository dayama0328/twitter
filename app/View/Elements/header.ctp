<div style="height:30px;">
<span style="float:left;">
<h1><?=$this->Html->link('Twitter', array('controller' => 'tweets', 'action' => 'index')); ?></h1>
</span>

<span style="float:right; margin:auto 10px;">
<?php if($isLogin) : ?>
  <?=$this->Html->link('ログアウト', array('controller' => 'users', 'action' => 'logout')); ?>
  <?php else : ?>
    <?=$this->Html->link('ログイン', array('controller' => 'users', 'action' => 'login')); ?>
<?php endif; ?>
</span>

<?php if(!$isLogin) : ?>
  <span style="float:right; margin:auto 10px;">
    <?=$this->Html->link('新規会員登録', array('controller' => 'users', 'action' => 'add')); ?>
  </span>
<?php endif; ?>

<span style="float:right; margin:auto 10px;">
<?php if(!$isLogin) : ?>
  <?=$this->Html->link('Facebookログイン', array('controller' => 'users', 'action' => 'facebook'))?>
<?php else : ?>
  <?=$this->Html->link('ユーザー情報編集', array('controller' => 'users', 'action' => 'edit')); ?>
<?php endif; ?>
</div>