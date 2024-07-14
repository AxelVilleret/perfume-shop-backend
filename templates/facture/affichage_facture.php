<?php $title = "Gestion des clients"; ?>

<?php ob_start(); ?>
<?php require('templates/autres/background.php') ?>
<h1 class="title">GESTION DES COMMANDES</h1>
<a href="index.php?action=export_csv"><iconify-icon icon="material-symbols:export-notes" width="40" class="icone1"></iconify-icon></a>
<a href="index.php"><iconify-icon icon="material-symbols:home" width="40" class="icone2"></iconify-icon></a>

<div class="ligne2">
    <p>No. Commande : <?= $commande->id_commande ?></p>
    <p>Date de commande : <?php $date = new DateTime($commande->date_commande);
                            echo ($date->format("Y-m-d")) ?></p>
    <p>No. Facture : <?= $facture->id_facture ?></p>
    <p>Date Facture : <?php $date = new DateTime($facture->date_creation);
                        echo ($date->format("Y-m-d")) ?></p>
</div>

<div class="ligne2" style="float: right;">
    <p>No. Client : <?= $client->id_client ?></p>
    <p>Nom Client : <?= $client->nom ?></p>
    <p>Adresse : <?= $client->adresse ?></p>
    <p>Téléphone : <?= $client->telephone ?></p>
</div>

<div style="padding-top: 30px; padding-bottom: 30px;">
    <div class="ligne2">
    <table border=1 frame=void rules=rows>
        <thead>
            <th>N°</th>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix unitaire</th>
            <th>Prix total</th>
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
                        <?= $quantites[$article->id_article] ?>
                    </td>
                    <td>
                        <?= $article->prix_magasin ?> $
                    </td>
                    <td>
                        <?= $article->prix_magasin * $quantites[$article->id_article] ?>
                    </td>
                </tr>

            <?php
            }
            ?>

        </tbody>
    </table>
</div>
</div>


<div class="ligne2" style="float: right;">
    <p>Montant Commande : <?= $commande->total ?> $</p>
    <p>Frais Livraison : <?= $commande->frais_livraison ?> $</p>
    <p>Promotion/Remise : 0 $</p>
    <p>Dépôt : <?= $commande->frais_depot ?> $</p>
    <p>Montant de la Facture : <?= $facture->montant ?> $</p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('templates/autres/layout.php') ?>