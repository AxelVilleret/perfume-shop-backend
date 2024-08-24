
<?php
require_once('src/lib/Database.php');
require_once('src/model/Stock.php');
class Article {
    public int $id;
    public string $nom_article;
    public float $prix_commande;
    public float $prix_magasin;
    public float $prix_vip;
    
}

class ArticleRepository
{
    public DatabaseConnection $connection;

    //addArticle
    public function addArticle(string $nom_article, float $prix_commande, float $prix_magasin, float $prix_vip, string $statut_article, int $quantite_produit): bool
    {
        $statement1 = $this->connection->getConnection()->prepare(
            "INSERT INTO article (nom_article, prix_commande, prix_magasin, prix_vip) VALUES (?, ?, ?, ?)"
        );
        #initialiser le stock
        $statement2 = $this->connection->getConnection()->prepare(
            "INSERT INTO stock (statut_article, quantite_produit, id_article) VALUES (?, ?, ?)"
        );
       $res1 = $statement1->execute([$nom_article, $prix_commande, $prix_magasin, $prix_vip]);
        if($res1>0){
            $idArticle = $this->connection->getConnection()->lastInsertId();
            $res2 = $statement2->execute([$statut_article, $quantite_produit, $idArticle]);
            if($res2>0){
                return true;
            }
        }
        return false;
    }

    //getquentite and statut from stock
    public function getStock(): Stock
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM stock"
        );
        $statement->execute();
        $stock = new Stock();
        while (($row = $statement->fetch())){
            $stock->statut_article = $row['statut_article'];
            $stock->quantite_produit = $row['quantite_produit'];
        }
        return $stock;
    }

    //delete article
    public function deleteArticle(int $id_article): bool
    {
        $statement1 = $this->connection->getConnection()->prepare(
            "DELETE FROM article WHERE id_article = ?"
        );
        $statement2 = $this->connection->getConnection()->prepare(
            "DELETE FROM stock WHERE id_article = ?"
        );
        $res1 = $statement1->execute([$id_article]);
        if($res1>0){
            $res2 = $statement2->execute([$id_article]);
            if($res2>0){
                return true;
            }
        }  
        return false; 
    }

    //update article
    public function updateArticle(int $id_article, string $nom_article, float $prix_commande, float $prix_magasin, float $prix_vip, string $statut_article, int $quantite_produit): bool
    {
        $statement1 = $this->connection->getConnection()->prepare(
            "UPDATE article SET nom_article = ?, prix_commande = ?, prix_magasin = ?, prix_vip = ? WHERE id_article = ?"
        );
        $statement2 = $this->connection->getConnection()->prepare(
            "UPDATE stock SET statut_article = ?, quantite_produit = ? WHERE id_article = ?"
        );
        $res1 = $statement1->execute([$nom_article, $prix_commande, $prix_magasin, $prix_vip, $id_article]);
        if($res1>0){
            $res2 = $statement2->execute([$statut_article, $quantite_produit, $id_article]);
            if($res2>0){
                return true;
            }
        }
        return false;
    }

    public function getIdArticleByName(string $nom_article): int
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id_article FROM article WHERE nom_article = ?"
        );
        $statement->execute([$nom_article]);
        $row = $statement->fetch();
        $id_article = $row['id_article'];
        return $id_article;
    }
}