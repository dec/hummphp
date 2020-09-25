
<?php if (!$this) { exit; } ?>

<?php $this->displayView('SystemPreHeader') ?>
 <title><?php e('Humm PHP - Error') ?></title>
<?php $this->displayView('SystemPosHeader') ?>

<section>
 <h1>
  <?php e('Humm PHP error') ?>
 </h1>
 <p>
  <?php e('Humm PHP is working but you need to provide at least one Home site view. If you need more information, please, visit the Humm PHP website at:') ?>
 </p>
 <p>
  <a href="<?= $hummPhpSiteUrl ?>"
   title="<?php e('Visit the Humm PHP website') ?>">http://www.decsoftutils.com</a>
 </p>
</section>

<?php $this->displayView('SystemPreFooter') ?>
<?php $this->displayView('SystemPosFooter') ?>
