
<?php if (!$this) { exit; } ?>

<?php $this->displayView('SystemPreHeader') ?>
 <title><?php e('Humm PHP - Error') ?></title>
 <link rel="stylesheet" type="text/css" href="<?= $systemViewsStylesUrl ?>SystemHome.css" media="all" />
<?php $this->displayView('SystemPosHeader') ?>

<div class="container text-center alert alert-warning mt-5">
  
 <h1 class="display-5">
  <?php e('Humm PHP error') ?>
 </h1>
 <p class="lead mt-5">
  <?php e('Humm PHP is working but you need to provide at least one Home site view. If you need more information, please, visit the Humm PHP website at:') ?>
 </p>
 <footer class="mt-5">
  <div>
   <a href="<?= $hummPhpSiteUrl ?>" class="alert-link text-decoration-none" title="<?php e('Visit the Humm PHP website') ?>"><?= $hummPhpSiteUrl ?></a>
  </div>   
  <div>
   ©<?= \date('Y') ?> Humm PHP <?= $hummVersion ?>
  </div>
 </footer> 
 
</div>
<!-- /container -->

<?php $this->displayView('SystemPreFooter') ?>
<?php $this->displayView('SystemPosFooter') ?>
