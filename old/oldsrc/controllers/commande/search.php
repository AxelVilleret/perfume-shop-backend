<?php
require_once('src/lib/database.php');
require_once('src/model/commande.php');
Class SearchArticle
{
    public function execute(array $input) {
        $search = new CommandeRepository();
        $search->connection = new DatabaseConnection();
        // $results = $search->searchArticles($input['search_query']);
        $results = $search->searchArticles('cha');

        header('Content-Type: application/json');
        echo json_encode($results);
        // $id_commande = $_GET['id_commande'];
        // require('templates/commande/ajouter_article_pour_commande.php');
        
    }
}