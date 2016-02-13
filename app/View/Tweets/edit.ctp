<h2>ツイートの編集</h2>
<?=$this->Form->create('Tweet', array('action' => 'edit')); ?>
<?=$this->Form->input('content', array('label' => 'ツイート')); ?>
<?=$this->Form->hidden('id'); ?>
<?=$this->Form->end('編集する'); ?>