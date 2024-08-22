<?php $title = "Consulter une fiche client"; ?>

<?php ob_start(); ?>
<!-- <?php require('./templates/autres/background.php') ?> -->
<h1 class="title">Consulter une commande</h1>
<a href="index.php"><iconify-icon icon="material-symbols:home" width="40" class="icone2"></iconify-icon></a>
<div class="ligne" style="display: flex;">
    <div class="infoLeft">
        <h1>Commande </h1>
        <p>Numero de commande: "<?= $commande->id_commande ?>" </p>
        <p> Numero client : "<?= $commande->id_client ?>" </p>
        <p>Statut : "<?= $commande->statut ?>"</p>
        <p>Date de commande : "<?= $commande->date_commande ?>"</p>
        <p>Date d'expedition : "<?= $commande->date_expedition ?>"</p>
        <h1>Paiement</h1>
        <?php foreach ($paiements as $paiements) : ?>
            <p>Numero de paiement : "<?= $paiements->id_paiement ?>"</p>
            <p>Montant : "<?= $paiements->montant ?>"</p>
            <p>Date : "<?= $paiements->date ?>"</p>
            <p>Mode de paiement : "<?= $paiements->mode_paiement ?>"</p>
        <?php endforeach; ?>
        <div>
            <h1>Factures</h1>
            <?php foreach ($facture as $facture) : ?>
                <p>Facture numero "<?= $facture->id_facture ?>"</p>
                <p>Facture du : "<?= $facture->date_creation ?>"</p>
                <p>Montant : "<?= $facture->montant ?>"</p>
                <td>
                    <a href="#">
                        <iconify-icon icon="ic:baseline-remove-red-eye" width="30"></iconify-icon>
                    </a>
                </td>
            <?php endforeach; ?>

        </div>
    </div>
    <div class="rightInfo">
        <p>Frais de livraison : "<?= $commande->date_commande ?>"</p>
        <p>Frais de depot : "<?= $commande->frais_depot ?>"</p>
        <p>Note : "<?= $commande->note ?>"</p>
        <p>Frais de livraison : "<?= $commande->date_livraison ?>"</p>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('./templates/autres/layout.php') ?>