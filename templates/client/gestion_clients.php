<?php $title = "Gestion des clients"; ?>

<?php ob_start(); ?>
<?php require('./templates/autres/background.php') ?>
<h1 class="title">GESTION DES CLIENTS</h1>
<a href="index.php?action=form_ajoutclient"><iconify-icon icon="ic:round-person-add" width="40" class="icone1" ></iconify-icon></a>
<a href="index.php"><iconify-icon icon="material-symbols:home" width="40" class="icone2"></iconify-icon></a>
<div class="ligne">
    <table border=1 frame=void rules=rows>
        <thead>
            <th>N°</th>
            <th>Nom</th>
            <th>Tel</th>
            <th>Email</th>
        </thead>
        <tbody>
            <?php
            foreach ($clients as $client) {
            ?>

                <tr>

                    <td>
                        <?= $client->id_client ?>
                    </td>
                    <td>
                        <?= $client->nom ?>
                    </td>
                    <td>
                        <?= $client->telephone ?>
                    </td>
                    <td>
                        <?= $client->email ?>
                    </td>
                    <td>
                        <a href="index.php?action=consulter_fiche_client&id_client=<?= $client->id_client ?>">
                            <iconify-icon icon="ic:baseline-remove-red-eye" width="30"></iconify-icon>
                        </a>
                    </td>
                    <td>
                        <a href="index.php?action=form_modifier_fiche_client&id_client=<?= $client->id_client ?>">
                            <iconify-icon icon="material-symbols:edit" width="30"></iconify-icon>
                        </a>
                    </td>
                    <td>
                        <a href="index.php?action=delete_client&id_client=<?= $client->id_client ?>">
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

<?php require('./templates/autres/layout.php') ?>