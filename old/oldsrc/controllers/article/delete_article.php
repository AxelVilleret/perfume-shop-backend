<?php
require_once('src/lib/database.php');
require_once('src/model/Article.php');
class DeleteArticle
{
    public function execute(int $id_article){
        $article = new ArticleRepository();
        $article->connection = new DatabaseConnection();
        $success = $article->deleteArticle($id_article);
        if (!$success) {
            throw new \Exception('Impossible de supprimer l\'article !');
        } else {
            header('Location: index.php?action=gestion_des_articles');
        }
    }
}