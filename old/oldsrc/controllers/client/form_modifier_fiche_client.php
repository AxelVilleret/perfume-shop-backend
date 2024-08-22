<?php

class FormModifClient {
    public function execute(int $id_client) {
        $client = new ClientRepository();
        $client->connection = new DatabaseConnection();
        $client = $client->getClientById($id_client);
        require('templates/client/modifier_fiche_client.php');
    }
    
}

?>