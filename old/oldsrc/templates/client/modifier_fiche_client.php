<?php $title = "Gestion des clients"; ?>
<?php ob_start(); ?>
<?php require('./templates/autres/background.php') ?>
<h1 class="title">Modifier une fiche un client</h1>
<a href="index.php"><iconify-icon icon="material-symbols:home" width="40" class="icone2"></iconify-icon></a>
<div class="formulaire">
    <form action="index.php?action=modifier_fiche_client&id_client=<?= $client->id_client ?>" method="post" >
        <div class="group-1">
            <label for="nom">Nom</label></br>
            <input type="text" id="nom" name="nom" placeholder="Nom du client" value="<?= $client->nom ?>" required></br>
            <label for="facebook">facebook</label></br>
            <input type="facebook" id="facebook" name="facebook" placeholder="facebook" value="<?= $client->facebook ?>" required></br>
            <label for="telephone">Téléphone</label></br>
            <input type="telephone" id="telephone" name="telephone" placeholder="Téléphone du client" value="<?= $client->telephone ?>" required></br>
        </div>
        <div class="group-2">
            <label for="adresse">Adresse</label></br>
            <input type="adresse" id="adresse" name="adresse" placeholder="Adresse du client" value="<?= $client->adresse ?>" required></br>
            <label for="instagram">Instagram</label></br>
            <input type="instagram" id="instagram" name="instagram" placeholder="Instagram" value="<?= $client->instagram ?>" required></br>
            <label for="email">Email</label></br>
            <input type="email" id="email" name="email" placeholder="Email du client" value="<?= $client->email ?>" required></br>
        </div>
        <input type="submit" class="boutton" value="Modifier">
    </form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('./templates/autres/layout.php') ?>