<?php

require_once('src/lib/database.php');
require_once('src/model/client.php');

class ConsulterFicheClient
{
    public function execute(int $id_client)
    {
        $connection = new DatabaseConnection();
        $clientRepository = new ClientRepository();
        $clientRepository->connection = $connection;
        $client = $clientRepository->getClientById($id_client);
        $commande = $clientRepository->getCommandsClient($id_client);
        $membership = $clientRepository->getMembershipClient($id_client);
        $solde = $clientRepository->getPointsClient($id_client);
        require('templates/client/consulter_fiche_client.php');
        
    }
}


