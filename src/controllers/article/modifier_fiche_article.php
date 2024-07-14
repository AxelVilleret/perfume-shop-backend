<?php
require_once('src/lib/database.php');
require_once('src/model/Article.php');
class UpdateArticle
{
    public function execute(int $id, array $input) {
        $article = new ArticleRepository();
        $article->connection = new DatabaseConnection();
        $success = $article->updateArticle($id, $input['nom_article'], $input['prix_commande'], $input['prix_magasin'], $input['prix_vip'], $input['statut_article'], $input['quantite_produit']);
        if (!$success) {
            throw new \Exception('Impossible de modifier l\'article !');
        } else {
            header('Location: index.php?action=gestion_des_articles');
        }
    }
}
