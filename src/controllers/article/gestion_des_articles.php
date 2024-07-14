<?php

require_once('src/lib/database.php');
require_once('src/model/client.php');

class GestionArticles
{
    public function execute()
    {
        $connection = new DatabaseConnection();
        $articleRepository = new ArticleRepository();
        $articleRepository->connection = $connection;
        $articles = $articleRepository->getArticles();
        require('templates/article/gestion_des_articles.php');
        
    }
}


