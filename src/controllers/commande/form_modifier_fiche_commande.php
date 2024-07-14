<?php

class FormModifCommande {
    public function execute(int $id_commande) {
        $commandeRepo = new CommandeRepository();
        $commandeRepo->connection = new DatabaseConnection();
        $commande = $commandeRepo->getCommandById($id_commande);
        require('templates/commande/modifier_fiche_commande.php');
    }
    
}

?>