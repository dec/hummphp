
<?php if (!$this) { exit; } ?>

<?php $this->displayView('PreHeader') ?>
<title><?php e('Humm PHP - Home') ?></title>
<?php $this->displayView('PosHeader') ?>

 <div class="jumbotron">
  <h1 class="display-3"><i class="fa fa-info" aria-hidden="true"></i> <?php e('Welcome!') ?></h1>
  <p class="lead"><?php e('This is the Home template of this Humm PHP installation. You can try also with the About template and of course add more templates!') ?></p>
 </div>

<?php $this->displayView('PreFooter') ?>
 <script type="text/javascript" src="<?= $viewsScriptsUrl ?>Home.js"></script>
<?php $this->displayView('PosFooter') ?>
