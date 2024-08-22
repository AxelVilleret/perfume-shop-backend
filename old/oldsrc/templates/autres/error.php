<?php $title = "Le blog de l'AVBN"; ?>

<?php ob_start(); ?>
<h1>Conciergerie</h1>
<p>Une erreur est survenue : <?= $errorMessage ?></p>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
