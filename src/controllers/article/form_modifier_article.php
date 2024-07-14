<?php
class FormModifArticle{
    public function execute(int $id_article){
        $a = new ArticleRepository();
        $a->connection = new DatabaseConnection();
        $article = $a->getArticleById($id_article);
        $stocks = $a->getStock();
        //print_r($stocks);
        require('templates/article/modifier_fiche_article.php');
    }
}