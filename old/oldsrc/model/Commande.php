<?php

require_once('src/lib/Database.php');
require_once('src/model/Facture.php');
require_once('src/model/Paiement.php');
require_once('src/model/Article.php');
class Commande
{
    public int $id;
    public string $date_commande;
    public float $total;
    public string $date_livraison;
    public float $frais_depot;
    public float $restant_a_payer;
    public float $frais_livraison;
    public String $statut;
    public String $date_expedition;
    public String $note;
    public int $id_client;
}

class CommandeRepository
{
    public DatabaseConnection $connection;

    public function addCommand(String $date_commande, float $total, String $date_livraison, float $frais_depot, float $restant_a_payer, float $frais_livraison, String $statut, String $date_expedition, String $note, int $id_client): int
    {
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO commande (date_commande, total, date_livraison, frais_depot, restant_a_payer, frais_livraison, statut, date_expedition, note, id_client) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $date_commande = date("Y-m-d H:i:s", strtotime($date_commande));
        $date_livraison = date("Y-m-d H:i:s", strtotime($date_livraison));
        $date_expedition = date("Y-m-d H:i:s", strtotime($date_expedition));
        $statement->execute([$date_commande, $total, $date_livraison, $frais_depot, $restant_a_payer, $frais_livraison, $statut, $date_expedition, $note, $id_client]);
        return $this->connection->getConnection()->lastInsertId();
    }

    //update commande
    public function updateCommand(int $id_commande, String $date_commande, float $total, String $date_livraison, float $frais_depot, float $restant_a_payer, float $frais_livraison, String $statut, String $date_expedition, String $note, int $id_client): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE commande SET date_commande = ?, total = ?, date_livraison = ?, frais_depot = ?, restant_a_payer = ?, frais_livraison = ?, statut = ?, date_expedition = ?, note = ?, id_client = ? WHERE id_commande = ?"
        );
        $date_commande = date("Y-m-d H:i:s", strtotime($date_commande));
        $date_livraison = date("Y-m-d H:i:s", strtotime($date_livraison));
        $date_expedition = date("Y-m-d H:i:s", strtotime($date_expedition));
        return $statement->execute([$date_commande, $total, $date_livraison, $frais_depot, $restant_a_payer, $frais_livraison, $statut, $date_expedition, $note, $id_client, $id_commande]) > 0;
    }

    //deleteCommande
    public function deleteCommande(int $id_commande): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "DELETE FROM commande WHERE id_commande = ?"
        );
        $statement->execute([$id_commande]);
        $statement = $this->connection->getConnection()->prepare(
            "DELETE FROM facture WHERE id_commande = ?"
        );
        $statement->execute([$id_commande]);
        $statement = $this->connection->getConnection()->prepare(
            "DELETE FROM article_commande WHERE id_commande = ?"
        );
        $statement->execute([$id_commande]);
        
        return $statement->rowCount() > 0;
    }

    public function getArticlesRestants(int $id_commande, array $articles): array
    {
        $articlesRestants = array();
        foreach ($articles as $article) {
            $statement = $this->connection->getConnection()->prepare(
                "SELECT quantite_commande FROM article_commande WHERE id_article = ? AND id_commande = ?"
            );
            $statement->execute([$article->id_article, $id_commande]);
            $row = $statement->fetch();
            $articlesRestants[$article->id_article] = $row['quantite_commande'];
        }
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * from article_facture WHERE id_facture = ANY (SELECT id_facture FROM facture WHERE id_commande = ?)"
        );
        $statement->execute([$id_commande]);
        while (($row = $statement->fetch())) {
            foreach ($articlesRestants as $key => $value) {
                if ($key == $row['id_article']) {
                    $articlesRestants[$key] -= $row['Quantite'];
                }
            }
        }
        return $articlesRestants;
    }

    public function addFacture(int $id_commande, array $articles): int
    {
        $montant = 0;
        foreach ($articles as $key => $value) {
            $statement = $this->connection->getConnection()->prepare(
                "SELECT prix_magasin FROM article WHERE nom_article = ?"
            );
            $statement->execute([str_replace("_", " ", $key)]);
            $row = $statement->fetch();
            $montant += $row['prix_magasin'] * $value;
        }

        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO facture (date_creation, date_mise_a_jour, montant, id_commande) VALUES (?, ?, ?, ?)"
        );
        $statement->execute([date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), $montant, $id_commande]);
        $id_facture = $this->connection->getConnection()->lastInsertId();
        foreach ($articles as $key => $value) {
            if ($value == 0) {
                continue;
            }
            $statement = $this->connection->getConnection()->prepare(
                "SELECT id_article FROM article WHERE nom_article = ?"
            );
            $statement->execute([str_replace("_", " ", $key)]);
            $row = $statement->fetch();
            $id_article = $row['id_article'];
            $statement = $this->connection->getConnection()->prepare(
                "INSERT INTO article_facture (id_article, id_facture, Quantite) VALUES (?, ?, ?)"
            );
            $statement->execute([$id_article, $id_facture, $value]);
        }
        return $id_facture;
    }

    public function getQuantitesArticlesByFacture(int $id_facture): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM article_facture WHERE id_facture = ?"
        );
        $statement->execute([$id_facture]);
        $articles = [];
        while (($row = $statement->fetch())) {
            $articles[$row['id_article']] = $row['Quantite'];
        }
        return $articles;
    }

    public function addArticleCommande(int $id_commande, int $id_article, int $quantite): void
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT quantite_commande FROM article_commande WHERE id_article = ? AND id_commande = ?"
        );

        $statement->execute([$id_article, $id_commande]);
        if ($statement->rowCount() == 0) {
            $statement = $this->connection->getConnection()->prepare(
                "INSERT INTO article_commande (id_article, id_commande, quantite_commande) VALUES (?, ?, ?)"
            );
            $statement->execute([$id_article, $id_commande, $quantite]);
            return;
        }
        $row = $statement->fetch();
        $quantite += $row['quantite_commande'];
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE article_commande SET quantite_commande = quantite_commande + ? WHERE id_article = ? AND id_commande = ?"
        );
        $statement->execute([$quantite, $id_article, $id_commande]);
    }
}
