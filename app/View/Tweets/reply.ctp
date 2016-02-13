<h2><?php echo $post['Tweet']['username'].'@'.$post['Tweet']['acountname'] ?>さんのツイートへ返信</h2>
<p><?php echo $post['Tweet']['content'] ?></p>
<p><?php echo $post['Tweet']['created'] ?></p>
<div>
  <?=$this->Form->create('Reply', array('action' => 'reply')); ?>
  <?=$this->Form->input('content', array('label' => '返信')); ?>
  <?=$this->Form->hidden('tweet_id' , array('value' => $post['Tweet']['id'])); ?>
  <?=$this->Form->end('返信する'); ?>
</div>

<div>
<?php foreach($reply as $value) : ?>
  <p><?=$value['Reply']['username'].'@'.$value['Reply']['acountname']?></p>
  <p><?=$value['Reply']['content']?></p>
  <p><?=$value['Reply']['created']?></p>
  <hr>
<?php endforeach; ?>

</div>