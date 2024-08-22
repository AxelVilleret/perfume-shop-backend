<?php $title = "Gestion des clients"; ?>

<?php ob_start(); ?>
<?php require('templates/autres/background.php') ?>
<h1 class="title">GESTION DES COMMANDES</h1>
<a href="index.php?action=export_csv"><iconify-icon icon="material-symbols:export-notes" width="40" class="icone1"></iconify-icon></a>
<a href="index.php"><iconify-icon icon="material-symbols:home" width="40" class="icone2"></iconify-icon></a>
<div class="ligne">
    <table border=1 frame=void rules=rows>
        <thead>
            <th>N°</th>
            <th>Numéro client</th>
            <th>Statut</th>
            <th>Date d'expédition</th>
            <th>Frais de livraison</th>
            <th>Total</th>
        </thead>
        <tbody>
            <?php
            foreach ($commande as $commande) {
            ?>
                <tr>
                    <td>
                        <?= $commande->id_commande ?>
                    </td>
                    <td>
                        <?= $commande->id_client ?>
                    </td>
                    <td>
                        <?= $commande->statut ?>
                    </td>
                    <td>
                        <?php $date = new DateTime($commande->date_expedition);
                        echo ($date->format("Y-m-d")) ?>
                    </td>
                    <td>
                        <?= $commande->frais_livraison ?> $
                    </td>
                    <td>
                        <?= $commande->total ?> $
                    </td>
                    <td>
                        <a href="index.php?action=form_ajout_facture&id_commande=<?= $commande->id_commande ?>">
                            <iconify-icon icon="ri:bill-fill" width="30"></iconify-icon>
                        </a>
                    </td>
                    <td>
                        <a href="index.php?action=form_modifier_fiche_commande&id_commande=<?= $commande->id_commande ?>">
                            <iconify-icon icon="material-symbols:edit" width="30"></iconify-icon>
                        </a>
                    </td>
                    <td>
                        <a href="index.php?action=consulter_commande&id_commande=<?= $commande->id_commande ?>">
                            <iconify-icon icon="ic:baseline-remove-red-eye" width="30"></iconify-icon>
                        </a>
                    </td>
                    <td>
                        <a href="index.php?action=delete_commande&id_commande=<?= $commande->id_commande ?>">
                            <iconify-icon icon="ic:baseline-delete" width="30" height="30"></iconify-icon>
                        </a>
                    </td>
                    <a href="index.php?action=form_ajoutCommande">
                    <input type="submit" class="boutton1" value="Ajouter une commande">
                    </a>
                    <a href="index.php?action=gestion_des_articles">
                    <input type="submit" class="bouttonArticle" value="Article">
                    </a>
                </tr>

            <?php
            }
            ?>

        </tbody>
    </table>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('templates/autres/layout.php') ?>