<?php
require_once('src/lib/database.php');
require_once('src/model/commande.php');
class DeleteCommande
{
    public function execute(int $id_commande) {
        $commande = new CommandeRepository();
        $commande->connection = new DatabaseConnection();
        $success = $commande->deleteCommande($id_commande);
        if (!$success) {
            throw new \Exception('Impossible de supprimer la commande !');
        } else {
            header('Location: index.php?action=gestion_commandes');
        }
    }
}