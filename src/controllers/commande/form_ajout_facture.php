<?php

class FormAjoutFacture {
    public function execute(int $id_commande) {
        $connection = new DatabaseConnection();
        $commandeRepository = new CommandeRepository();
        $commandeRepository->connection = $connection;
        $qArticles = $commandeRepository->getArticlesRestants($id_commande, $commandeRepository->getArticlesByCommande($id_commande));
        $isEmpty = true;
        foreach ($qArticles as $key => $qArticle) {
            if ($qArticles[$key] > 0) {
                $isEmpty = false;
            }
        }
        $articles = $commandeRepository->getArticlesByCommande($id_commande);
        require('templates/commande/form_ajout_facture.php');
    }
}

?>