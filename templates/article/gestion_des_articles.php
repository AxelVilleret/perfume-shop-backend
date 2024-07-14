<?php $title = "Gestion des clients"; ?>

<?php ob_start(); ?>
<?php require('templates/autres/background.php') ?>
<h1 class="title">GESTION DES ARTICLES</h1>
<a href="index.php?action=form_ajout_article"> <iconify-icon icon="icon-park-solid:add-one" width="40" class="icone1" ></iconify-icon></a>
<a href="index.php"><iconify-icon icon="material-symbols:home" width="40" class="icone2"></iconify-icon></a>
<div class="ligne">
    <table border=1 frame=void rules=rows>
        <thead>
            <th>N°</th>
            <th>Nom article</th>
            <th>Prix commande</th>
            <th>Prix magasin</th>
            <th>Prix VIP</th>
        </thead>
        <tbody>
            <?php
            foreach ($articles as $article) {
            ?>
                <tr>
                    <td>
                        <?= $article->id_article ?>
                    </td>
                  
                    <td>
                        <?= $article->nom_article ?>
                    </td>
                    <td>
                        <?= $article->prix_commande ?>
                    </td>
                    <td>
                        <?= $article->prix_magasin ?>
                    </td>
                    <td>
                        <?= $article->prix_vip ?>
                    </td>
                    <td>
                        <a href="index.php?action=form_modifier_fiche_article&id_article=<?= $article->id_article ?>">
                            <iconify-icon icon="material-symbols:edit" width="30"></iconify-icon>
                        </a>
                    </td>
                    <td>
                        <a href="index.php?action=delete_article&id_article=<?= $article->id_article ?>">
                            <iconify-icon icon="ic:baseline-delete" width="30" height="30"></iconify-icon>
                        </a>
                    </td>
                </tr>

            <?php
            }
            ?>

        </tbody>
    </table>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('templates/autres/layout.php') ?>