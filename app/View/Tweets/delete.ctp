<h2>ツイートの削除</h2>
<p>下記の投稿を削除してもよろしいですか？</p>
<?=$this->Form->create('Tweet', array('action' => 'delete')); ?>
<?=$this->Form->input('content', array('label' => 'ツイート', 'value' => $data['content'])); ?>
<?=$this->Form->hidden('id' , array('value' => $data['id'])); ?>
<?=$this->Form->end('削除する'); ?>