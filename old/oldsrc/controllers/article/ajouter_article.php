<?php

require_once('src/lib/database.php');
require_once('src/model/client.php');
class AjoutArticle
{
    public function execute(array $input) {
        $article = new ArticleRepository();
        $article->connection = new DatabaseConnection();
        $success = $article->addArticle($input['nom_article'], $input['prix_commande'], $input['prix_magasin'], $input['prix_vip'], $input['statut_article'], $input['quantite_produit']);
        if (!$success) {
            throw new \Exception('Impossible d\'ajouter le client !');
        } else {
            header('Location: index.php?action=gestion_des_articles');
        }
    }
}