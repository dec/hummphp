
<?php if (!$this) { exit; } ?>

<?php $this->displayView('PreHeader') ?>
<title><?php e('Humm PHP - About') ?></title>
<?php $this->displayView('PosHeader') ?>

 <div class="jumbotron">
  <h1 class="display-3"><?php e('About!') ?></h1>
  <p class="lead"><?php e('This is the About template of this Humm PHP installation. It\'s a template in addition to the Home one to allow you to take a look!!') ?></p>
 </div>

<?php $this->displayView('PreFooter') ?>
 <script type="text/javascript" src="<?= $viewsScriptsUrl ?>About.js"></script>
<?php $this->displayView('PosFooter') ?>
