<?php

require_once('src/lib/database.php');
require_once('src/model/Facture.php');
require_once('src/model/Paiement.php');
require_once('src/model/Article.php');
class Commande
{
    public int $id_commande;
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
    public function getCommands(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM commande ORDER BY id_commande"
        );
        $commandes = [];
        while (($row = $statement->fetch())) {
            $commande = new commande();
            $commande->id_commande = $row['id_commande'];
            $commande->date_commande = $row['date_commande'];
            $commande->total = $row['total'];
            $commande->date_livraison = $row['date_livraison'];
            $commande->frais_depot = $row['frais_depot'];
            $commande->restant_a_payer = $row['restant_a_payer'];
            $commande->frais_livraison = $row['frais_livraison'];
            $commande->statut = $row['statut'];
            $commande->date_expedition = $row['date_expedition'];
            $commande->note = $row['note'];
            $commande->id_client = $row['id_client'];
            $commandes[] = $commande;
        }
        return $commandes;
    }

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

    //getCommandById
    public function getCommandById(int $id_commande): Commande
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM commande WHERE id_commande = ?"
        );
        $statement->execute([$id_commande]);
        $row = $statement->fetch();
        $commande = new Commande();
        $commande->id_commande = $row['id_commande'];
        $commande->date_commande = $row['date_commande'];
        $commande->total = $row['total'];
        $commande->date_livraison = $row['date_livraison'];
        $commande->frais_depot = $row['frais_depot'];
        $commande->restant_a_payer = $row['restant_a_payer'];
        $commande->frais_livraison = $row['frais_livraison'];
        $commande->statut = $row['statut'];
        $commande->date_expedition = $row['date_expedition'];
        $commande->note = $row['note'];
        $commande->id_client = $row['id_client'];
        return $commande;
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

    //getfacture
    public function getFacture(int $id_commande): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM facture WHERE id_commande = ?"
        );
        $statement->execute([$id_commande]);
        $factures = [];
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $facture = new Facture();
            $facture->id_facture = $row['id_facture'];
            $facture->date_creation = $row['date_creation'];
            $facture->date_mise_a_jour = $row['date_mise_a_jour'];
            $facture->montant = $row['montant'];
            $facture->id_commande = $row['id_commande'];
            $factures[] = $facture;
        }
        return $factures;
    }
    //getPaiement
    public function getPaiements(int $id_commande): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM paiement WHERE id_commande = ?"
        );
        $statement->execute([$id_commande]);
        $paiements = [];
        $paiement = new Paiement();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $paiement->id_paiement = $row['id_paiement'];
            $paiement->montant = $row['montant'];
            $paiement->date_paiement = $row['$date_paiement'];
            $paiement->type = $row['type'];
            $paiement->id_commande = $row['id_commande'];
            $paiements[] = $paiement;
        }
        return $paiements;
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

    public function getArticlesByCommande(int $id_commande): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM article join article_commande on article.id_article = article_commande.id_article WHERE id_commande = ?"
        );
        $statement->execute([$id_commande]);
        $articles = [];
        while (($row = $statement->fetch())) {
            $article = new Article();
            $article->id_article = $row['id_article'];
            $article->nom_article = $row['nom_article'];
            $article->prix_commande = $row['prix_commande'];
            $article->prix_magasin = $row['prix_magasin'];
            $article->prix_vip = $row['prix_vip'];
            $articles[] = $article;
        }
        return $articles;
    }
    //pour chercher un article
    public function searchArticles($search_query): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM article WHERE nom_article LIKE ?"
        );
        $statement->execute(["%$search_query%"]);
        $articles = [];
        while (($row = $statement->fetch())) {
            $article = new Article();
            $article->id_article = $row['id_article'];
            $article->nom_article = $row['nom_article'];
            $article->prix_commande = $row['prix_commande'];
            $article->prix_magasin = $row['prix_magasin'];
            $article->prix_vip = $row['prix_vip'];
            $articles[] = $article;
        }
        return $articles;
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

    public function getFactureById(int $id_facture): Facture
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM facture WHERE id_facture = ?"
        );
        $statement->execute([$id_facture]);
        $row = $statement->fetch();
        $facture = new Facture();
        $facture->id_facture = $row['id_facture'];
        $facture->date_creation = $row['date_creation'];
        $facture->date_mise_a_jour = $row['date_mise_a_jour'];
        $facture->montant = $row['montant'];
        $facture->id_commande = $row['id_commande'];
        return $facture;
    }

    public function getArticlesByFacture(int $id_facture): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM article join article_facture on article.id_article = article_facture.id_article WHERE id_facture = ? ORDER BY nom_article"
        );
        $statement->execute([$id_facture]);
        $articles = [];
        while (($row = $statement->fetch())) {
            $article = new Article();
            $article->id_article = $row['id_article'];
            $article->nom_article = $row['nom_article'];
            $article->prix_commande = $row['prix_commande'];
            $article->prix_magasin = $row['prix_magasin'];
            $article->prix_vip = $row['prix_vip'];
            $articles[] = $article;
        }
        return $articles;
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
