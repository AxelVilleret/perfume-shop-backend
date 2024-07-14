<?php $title = "Gestion des clients"; ?>

<?php ob_start(); ?>
<?php require('templates/autres/background.php') ?>
<h1 class="title">AJOUTER UNE COMMANDE</h1>
<a href="index.php?action=export_csv"><iconify-icon icon="material-symbols:export-notes" width="40" class="icone1"></iconify-icon></a>
<a href="index.php"><iconify-icon icon="material-symbols:home" width="40" class="icone2"></iconify-icon></a>
<?php if (!$isEmpty) { ?>
    <div class="formulaire">
        <form action="index.php?action=ajout_facture&id_commande=<?= $id_commande ?>" method="post">
            <div class="ligne">
                <table border=1 frame=void rules=rows>
                    <thead>
                        <th>N°</th>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire</th>
                        <th>Prix Total</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($articles as $article) {
                            if ($qArticles[$article->id_article] <= 0) {
                                continue;
                            }
                        ?>
                            <tr>
                                <td>
                                    <?= $article->id_article ?>
                                </td>
                                <td>
                                    <?= $article->nom_article ?>
                                </td>
                                <td>
                                    <select id="article<?= $article->id_article ?>" name="<?= $article->nom_article ?>">
                                        <?php
                                        for ($i = 0; $i <= $qArticles[$article->id_article]; $i++) {
                                            if ($i == $qArticles[$article->id_article])
                                                echo "<option value='$i' selected>$i</option>";
                                            else
                                                echo "<option value='$i'>$i</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <?= $article->prix_magasin ?>
                                </td>
                                <td>
                                    <?= $article->prix_magasin * $qArticles[$article->id_article] ?>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <input type="submit" name="valider" class="bouttonCommande" value="Valider">
            </div>
        </form>
    </div>
<?php } else { ?>
    <div class="formulaire">
        <p>Tous les articles ont été ajoutés à une facture...</p>
    </div>
<?php } ?>
<?php $content = ob_get_clean(); ?>

<?php require('templates/autres/layout.php') ?>