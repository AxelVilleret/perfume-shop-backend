<?php

class UpdateCommande
{
    public function execute(int $id_commande, array $input)
    {
        $commande = new CommandeRepository();
        $commande->connection = new DatabaseConnection();
        $commande->updateCommand($id_commande, $_POST['date_commande'], $_POST['total'], $_POST['date_livraison'], $_POST['frais_depot'], $_POST['restant_a_payer'], $_POST['frais_livraison'], $_POST['statut'], $_POST['date_expedition'], $_POST['note'], $_POST['id_client']);
        if (!$commande) {
            throw new \Exception('Impossible de modifier la commande !');
        } else {
            header('Location: index.php?action=gestion_commandes');
        }
    }
}
