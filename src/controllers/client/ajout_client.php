<?php

require_once('src/lib/database.php');
require_once('src/model/client.php');
class AjoutClient
{
    public function execute(array $input) {
        $client = new ClientRepository();
        $client->connection = new DatabaseConnection();
        $success = $client->addClient($input['nom'], $input['adresse'], $input['email'], $input['telephone'], $input['facebook'], $input['instagram']);
        if (!$success) {
            throw new \Exception('Impossible d\'ajouter le client !');
        } else {
            header('Location: index.php?action=gestion_clients');
        }
    }
}