<?php

require_once('src/lib/database.php');
require_once('src/model/commande.php');

class GestionCommandes
{
    public function execute()
    {
        $connection = new DatabaseConnection();
        $commandeRepository = new CommandeRepository();
        $commandeRepository->connection = $connection;
        $commande = $commandeRepository->getCommands();
        require('templates/commande/gestion_commandes.php');
        
    }
}


