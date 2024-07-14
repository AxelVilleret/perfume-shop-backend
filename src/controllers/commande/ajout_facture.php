<?php
require_once('src/lib/database.php');
require_once('src/model/commande.php');
class AjoutFacture
{
    public function execute(int $id_commande, array $input) {
        $cr = new CommandeRepository();
        $cr->connection = new DatabaseConnection();
        $clientRepository = new ClientRepository();
        $clientRepository->connection = new DatabaseConnection();
        unset($input['valider']);
        $id_facture = $cr->addFacture($id_commande, $input);

        $commande = $cr->getCommandById($id_commande);
        $client = $clientRepository->getClientById($commande->id_client);
        $articles = $cr->getArticlesByFacture($id_facture);
        $facture = $cr->getFactureById($id_facture);
        $quantites = $cr->getQuantitesArticlesByFacture($id_facture);
        require('templates/facture/affichage_facture.php');


        
        
    }
}