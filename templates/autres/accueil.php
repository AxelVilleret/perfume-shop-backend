<?php $title = "Accueil"; ?>

<?php ob_start(); ?>
<?php require('background.php') ?>

<div class="menu1">
    <a href="index.php?action=gestion_commandes">
        <img class="bordure" src="assets/img/Menu1-removebg-preview.png" alt="Menu 1" />
    </a>
    <h1>Gestion des commandes</h1>

</div>
<div class="menu2">
    <a href="index.php?action=gestion_clients">
        <img class="bordure" src="assets/img/Menu2-removebg-preview.png" alt="Menu 2" />
    </a>
    <h1>Gestion des clients</h1>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>