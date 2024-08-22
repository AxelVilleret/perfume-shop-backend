<?php $title = "Ajout d'une commande"; ?>
<?php ob_start(); ?>
<!-- <?php require('./templates/autres/background.php') ?> -->
<h1 class="title">Ajouter un article pour une commande</h1>
<a href="index.php"><iconify-icon icon="material-symbols:home" width="40" class="icone2"></iconify-icon></a>
<form action="index.php?action=search_article&id_commande=<?= $id_commande ?>" method="post">
  <input type="text" name="search_query" placeholder="Rechercher...">
  <input type="submit" value="Rechercher">
</form>
<h2>Résultats de la recherche</h2>


<?php if (isset($results)) {
  if (empty($results)) {
    echo "Aucun résultat";
  } else { ?>
  <form action="index.php?action=ajout_article_pour_commande&id_commande=<?= $id_commande ?>" method="post">
  <?php
    foreach ($results as $result) {
?>
      
        <?= $result->id_article ?><?= $result->nom_article ?> <input type="number" name="<?= $result->nom_article ?> "min="1" max="150" step="1" value="1">
        <br>

  <?php }
  }
} ?>
  <input type="submit" value="ajouter">
      </form>

      <?php $content = ob_get_clean(); ?>
      <?php require('./templates/autres/layout.php') ?>