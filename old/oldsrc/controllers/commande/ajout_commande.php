<?php
require_once('src/lib/database.php');
require_once('src/model/commande.php');
class AjoutCommande
{
    public function execute(array $input) {
        $commande = new CommandeRepository();
        $commande->connection = new DatabaseConnection();
        $id_commande = $commande->addCommand($input['date_commande'], $input['total'], $input['date_livraison'], $input['frais_depot'], $input['restant_a_payer'], $input['frais_livraison'], $input['statut'], $input['date_expedition'], $input['note'], $input['id_client']);
        require('templates/commande/ajouter_article_pour_commande.php');
    }
}