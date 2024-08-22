<?php $title = "Ajout d'une commande"; ?>
<?php ob_start(); ?>
<?php require('./templates/autres/background.php') ?>
<h1 class="title">Modifier une commande</h1>
<a href="index.php"><iconify-icon icon="material-symbols:home" width="40" class="icone2"></iconify-icon></a>
<div class="formulaire">
    <form action="index.php?action=modifier_fiche_commande&id_commande=<?= $commande->id_commande ?>" method="post">
        <div class="group-1">
            <label for="date">Date de commande</label></br>
            <input type="date" id="date_commande" name="date_commande" placeholder="date commande"  value="<?= $commande->date_commande ?>" required></br>
            <label for="total">Total</label></br>
            <input type="text" id="total" name="total" placeholder="total"  value="<?= $commande->total ?>" required></br>
            <label for="date">Date de livraison</label></br>
            <input type="date" id="date_livraison" name="date_livraison" placeholder="date livraison"  value="<?= $commande->date_livraison ?>" required></br>
            <label for="frais_depot">Frais de depot</label></br>
            <input type="text" id="frais_depot" name="frais_depot" placeholder="frais depot"  value="<?= $commande->frais_depot ?>" required></br>
            <label for="restant_a_payer">Restant a payer</label></br>
            <input type="text" id="restant_a_payer" name="restant_a_payer" placeholder="restant a payer"  value="<?= $commande->restant_a_payer ?>" required></br>
        </div>
        <div class="group-2">
            <label for="frais_livraison">Frais de livraison</label></br>
            <input type="text" id="frais_livraison" name="frais_livraison" placeholder="frais livraison" required></br>
            <label for="statut">Statut</label></br>
            <select id="statut" name="statut">
                <option value="Acheté">Acheté</option>
                <option value="Fini">Fini</option>
                <option value="Livré">Livré</option>
                <option value="Arrivé">Arrivé</option>
                <option value="Expédié">Expédié</option>
                <option value="Emballé">Emballé</option>
                <option value="Déja acheté">Déja acheté</option>
            </select> </br>
            <label for="date">Date d'expedition</label></br>
            <input type="date" id="date_expedition" name="date_expedition" placeholder="date expedition"  value="<?= $commande->date_expedition ?>" required></br>
            <label for="note">Note</label></br>
            <input type="text" id="note" name="note" placeholder="note"  value="<?= $commande->note ?>" required></br>
            <label for="id_client">Id client</label></br>
            <input type="text" id="id_client" name="id_client" placeholder="id client" value="<?= $commande->id_client ?>" required></br>
        </div>
        <input type="submit" class="bouttonCommande" value="Modifier">
    </form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('./templates/autres/layout.php') ?>