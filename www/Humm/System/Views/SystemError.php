
<?php if (!$this) { exit; } ?>

<?php $this->displayView('SystemPreHeader') ?>
 <title><?php e('Humm PHP - Error') ?></title>
 <link rel="stylesheet" type="text/css" href="<?= $systemViewsStylesUrl ?>SystemError.css" media="all" >
<?php $this->displayView('SystemPosHeader') ?>

<div class="container text-center alert alert-danger mt-5">

 <h1 class="display-5">
  <?php e('Humm PHP error') ?>
 </h1>

 <?php if(isset($errors) && is_array($errors)) : ?>

  <?php foreach($errors as $errorInfo) : ?>

   <ul class="list-group mt-5 text-start">
    <li class="list-group-item">
     <strong><?php e('Error:') ?></strong>
      <?= $errorInfo->errorCodeStr ?>
    </li>
    <li class="list-group-item">
     <strong><?php e('Message:') ?></strong>
      <?= $errorInfo->message ?>
    </li>
    <li class="list-group-item">
     <strong><?php e('File path.:') ?></strong>
      <small><?= $errorInfo->file ?></small>
    </li>
    <li class="list-group-item">
     <strong><?php e('Line num.:') ?></strong>
      <?= $errorInfo->lineNum ?>
    </li>
   </ul>

   <?php endforeach; ?>

 <?php else : ?>

  <p class="lead">
   <?php e('Sorry, an error occur, but Humm PHP is configured to hide more information.') ?>
  </p>

 <?php endif; ?>

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
