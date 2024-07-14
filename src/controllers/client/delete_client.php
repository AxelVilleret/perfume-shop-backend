<?php

require_once('src/lib/database.php');
require_once('src/model/client.php');
class DeleteClient
{
    public function execute(int $id_client) {
        $client = new ClientRepository();
        $client->connection = new DatabaseConnection();
        $success = $client->deleteClient($id_client);
        if (!$success) {
            throw new \Exception('Impossible de supprimer le client !');
        } else {
            header('Location: index.php?action=gestion_clients');
        }
    }
}