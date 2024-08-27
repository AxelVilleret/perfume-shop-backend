<?php

require_once 'src/model/Entity.php';

class Commande extends Entity
{
    public ?string $date_commande;
    public ?float $total;
    public ?string $date_livraison;
    public ?float $frais_depot;
    public ?float $restant_a_payer;
    public ?float $frais_livraison;
    public ?String $statut;
    public ?String $date_expedition;
    public ?String $note;
    public ?int $id_client;
    protected array $requiredFields = ['date_commande', 'total', 'date_livraison', 'frais_depot', 'restant_a_payer', 'frais_livraison', 'statut', 'date_expedition', 'note', 'id_client'];
}
