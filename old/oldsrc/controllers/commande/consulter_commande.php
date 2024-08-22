<?php

require_once('src/lib/database.php');
require_once('src/model/commande.php');

class ConsulterCommande
{
    public function execute(int $id_commande)
    {
        $connection = new DatabaseConnection();
        $commandeRepository = new CommandeRepository;
        $commandeRepository->connection = $connection;
        $commande = $commandeRepository->getCommandById($id_commande);
        $facture = $commandeRepository->getFacture($id_commande);
        $paiements = $commandeRepository->getPaiements($id_commande);
        require('templates/commande/consulter_commande.php');
        
    }
}


