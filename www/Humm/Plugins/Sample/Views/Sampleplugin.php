
<?php if (!$this) { exit; } ?>

<?php $this->displayView('PreHeader') ?>
<title><?php e('Humm PHP - Sample plugin view') ?></title>
<?php $this->displayView('PosHeader') ?>

 <div class="jumbotron bg-secondary text-white rounded p-5">
  <h1 class="display-3"><i class="fa fa-info-circle" aria-hidden="true"></i> <?= $headerTitle ?></h1>
  <p class="lead"><?php e('This is the Sample plugin template of this Humm PHP installation. It\'s a template in addition to the site ones to allow you to take a look!!') ?></p>
 </div>

<?php $this->displayView('PreFooter') ?>
<?php $this->displayView('PosFooter') ?>

