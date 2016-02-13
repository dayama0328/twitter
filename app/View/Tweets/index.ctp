<h2>プロフィール</h2>
<ul>
<li>アカウント名：<?=$user['acountname']; ?></li>
<li>ユーザーネーム：<?=$user['username']; ?></li>
<li>メールアドレス：<?=$user['email']; ?></li>
<li>ツイート：</li>
<li>お気に入り：</li>
</ul>

<h2>ツイート一覧</h2>
<?=$this->Session->flash('auth')?>
<p><?=$this->Html->link('新しくつぶやく', array('controller' => 'tweets', 'action' => 'add')); ?></p>
<?php foreach ($list as $data) : ?>
<ul>
  <li style="font-weight:bold;"><?=$data['Tweet']['username'].'@'.$data['Tweet']['acountname']; ?></li>
  <li style="font-size:24px;"><?=$data['Tweet']['content']; ?></li>
  <li style="font-size:12px;"><?=$this->Time->format($data['Tweet']['created'], '%Y/%m/%d %H:%M'); ?></li>
  <li>
    <?php echo $this->Html->link('[返信]', array('action' => 'reply', $data['Tweet']['id'])); ?>
      <?php if($user['id'] == $data['Tweet']['user_id']) : ?>
        <?php echo $this->Html->link('｜[編集]', array('action' => 'edit', $data['Tweet']['id'])); ?>
        <?php echo $this->Html->link('｜[削除]', array('action' => 'delete', $data['Tweet']['id'])); ?>
      <?php endif; ?>
  </li>
</ul>
<hr>
<?php endforeach; ?>