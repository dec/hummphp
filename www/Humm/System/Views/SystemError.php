
<?php if (!$this) { exit; } ?>

<?php $this->displayView('SystemPreHeader') ?>
 <title><?php e('Humm PHP - Error') ?></title>
 <link rel="stylesheet" type="text/css" href="<?= $systemViewsStylesUrl ?>Errors.css" media="all" />
<?php $this->displayView('SystemPosHeader') ?>

<section>
 <h1>
  <?php e('Humm PHP error') ?>
 </h1>

 <?php if(isset($errors) && is_array($errors)) : ?>

  <?php foreach($errors as $errorInfo) : ?>

   <ul class="errorList">
    <li>
     <strong><?php e('Error:') ?></strong>
      <?= $errorInfo->errorCodeStr ?>
    </li>
    <li>
     <strong><?php e('Message:') ?></strong>
      <?= $errorInfo->message ?>
    </li>
    <li>
     <strong><?php e('File path.:') ?></strong>
      <small><?= $errorInfo->file ?></small>
    </li>
    <li>
     <strong><?php e('Line num.:') ?></strong>
      <?= $errorInfo->lineNum ?>
    </li>
   </ul>
   <!-- /errorList -->

   <?php endforeach; ?>

 <?php else : ?>

  <p>
   <?php e('Sorry, an error occur, but Humm PHP is configured to hide more information.') ?>
  </p>

 <?php endif; ?>
  
</section>

<?php $this->displayView('SystemPreFooter') ?>
<?php $this->displayView('SystemPosFooter') ?>
