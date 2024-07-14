<?php
require_once('src/lib/database.php');
require_once('src/model/commande.php');
class AjoutArticleCommande
{
    public function execute(int $id_commande, array $input)
    {
        $commande = new CommandeRepository();
        $commande->connection = new DatabaseConnection();
        $ar = new ArticleRepository();
        $ar->connection = new DatabaseConnection();
        foreach ($input as $key => $value) {
            if ($value != 0) {
                $id_article = $ar->getIdArticleByName(str_replace('_', ' ', $key));
                $commande->addArticleCommande($id_commande, $id_article, $value);
            }
            
        }
        require('templates/commande/ajouter_article_pour_commande.php');
    }
}
