<?php $title = "Modife Article"; ?>
<?php ob_start(); ?>
<?php require('./templates/autres/background.php') ?>
<h1 class="title">Modifier un arcticle</h1>
<a href="index.php"><iconify-icon icon="material-symbols:home" width="40" class="icone2"></iconify-icon></a>
<div class="formulaire">
    <form action="index.php?action=modifier_fiche_article&id_article=<?= $article->id_article ?>" method="post" >
        <div class="group-1">
            <label for="text">Nom article</label></br>
            <input type="text" id="nom_article" name="nom_article" placeholder="nom article" value="<?= $article->nom_article ?>" required> </br>
            <label for="text">Prix commande</label></br>
            <input type="text" id="prix_commande" name="prix_commande" placeholder="prix commande" value="<?= $article->prix_commande ?>" required></br>
            <label for="statut">Statut Article</label></br>
            <select id="statut_article" name="statut_article">
            <!-- 'En stock','Disponible','Indisponible','Hors stock','Cadeau gratuit','Emballé','Expédié','Arrivé','Livré','Autre' -->
                <option value="En stock">En stock</option>
                <option value="Disponible">Disponible</option>
                <option value="Indisponible">Indisponible</option>
                <option value="Hors stock">Hors stock</option>
                <option value="Cadeau gratuit">Cadeau gratuit</option>
                <option value="Emballé">Emballé</option>
                <option value="Expédié">Expédié</option>
                <option value="Arrivé">Arrivé</option>
                <option value="Livré">Livré</option>
                <option value="Autre">Autre</option>
            </select> </br>
           
        </div>
        <div class="group-2">
        <label for="text">Prix magasin</label></br>
            <input type="text" id="prix_magasin" name="prix_magasin" placeholder="prix magasin" value="<?= $article->prix_magasin ?>" required></br>
            <label for="text">Prix vip</label></br>
            <input type="text" id="prix_vip" name="prix_vip" placeholder="prix vip" value="<?= $article->prix_vip ?>" required></br>
            <label for="quantite">Quantite</label></br>
            <input type="int" id="quantite_produit" name="quantite_produit" placeholder="quantite" value="<?= $stocks->quantite_produit ?>" required></br>
        </div>
        <input type="submit" class="bouttonCommande" value="Modifier">
    </form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('./templates/autres/layout.php') ?>