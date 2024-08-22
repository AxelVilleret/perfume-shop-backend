<?php

require_once('src/lib/database.php');
require_once('src/model/client.php');

class GestionClients
{
    public function execute()
    {
        $connection = new DatabaseConnection();
        $clientRepository = new ClientRepository();
        $clientRepository->connection = $connection;
        $clients = $clientRepository->getClients();
        require('templates/client/gestion_clients.php');
        
    }
}


