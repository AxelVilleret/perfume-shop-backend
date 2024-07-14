<?php $title = "Consulter une fiche client"; ?>

<?php ob_start(); ?>
<?php require('./templates/autres/background.php') ?>
<h1 class="title">Consulter une fiche client</h1>
<a href="index.php"><iconify-icon icon="material-symbols:home" width="40" class="icone2"></iconify-icon></a>
<div class="ligne" style="display: flex;">
    <div class="infoLeft">
        <h1>Clients </h1>
        <p>Nom : "<?= $client->nom ?>" </p>
        <p> Adresse : "<?= $client->adresse ?>" </p>
        <p>Téléphone : "<?= $client->telephone ?>"</p>
        <p>Email : "<?= $client->email ?>"</p>
        <p>Facebook : "<?= $client->facebook ?>"</p>
        <p>Instagram : "<?= $client->instagram ?>"</p>
        <div>
            <h1>Commandes</h1>
            <?php foreach ($commande as $commande) : ?>
                <p>Commande du "<?= $commande->date_commande ?>"</p>
                <p>Total : "<?= $commande->total ?>"</p>
                <p>Statut : "<?= $commande->statut ?>"</p>
                <td>
                    <a href="index.php?action=consulter_commande&id_commande=<?= $commande->id_commande ?>">
                        <iconify-icon icon="ic:baseline-remove-red-eye" width="30"></iconify-icon>
                    </a>
                </td>
                <td>
                    <a href="index.php?action=form_modifier_fiche_client&id_client=<?= $client->id_client ?>">
                        <iconify-icon icon="material-symbols:edit" width="30"></iconify-icon>
                    </a>
                </td>
            <?php endforeach; ?>

        </div>
    </div>
    <div class="rightInfo" >
        <h1>Membership</h1>
        <p>Nom : "<?= $membership ?>"</p>
        <h1>Solde de points</h1>
        <p>Points : "<?= $solde ?>"</p>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('./templates/autres/layout.php') ?>