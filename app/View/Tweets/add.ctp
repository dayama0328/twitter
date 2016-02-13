<h2>新規ツイート</h2>
<div>
  <?=$this->Form->create('Tweet', array('action' => 'add')); ?>
  <?=$this->Form->input('content', array('label' => 'ツイート')); ?>
  <?=$this->Form->end('新しくつぶやく'); ?>
</div>