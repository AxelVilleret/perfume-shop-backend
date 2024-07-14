<?php

require_once('src/lib/database.php');
require_once('src/model/client.php');
class UpdateClient
{
    public function execute(int $id, array $input) {
        $client = new ClientRepository();
        $client->connection = new DatabaseConnection();
        $success = $client->updateClient($id, $input['nom'], $input['adresse'], $input['email'], $input['telephone'], $input['facebook'], $input['instagram']);
        if (!$success) {
            throw new \Exception('Impossible de modifier le client !');
        } else {
            header('Location: index.php?action=gestion_clients');
        }
    }
}