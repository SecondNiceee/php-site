<?php
      use shop\View;
?>

<?php $this->getPart('parts/header'); ?>  
<?=$this->content;?>
<?= \app\widgets\FaqWidget::render('main', 0) ?>
<?php $this->getPart('parts/footer'); ?>
