<?php

require_once 'src/model/Entity.php';

class Commande extends Entity
{
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
