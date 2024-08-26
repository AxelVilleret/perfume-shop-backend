<?php

require_once 'src/model/Entity.php';

class Paiement extends Entity
{
    public float $montant;
    public string $date_paiement;
    public string $type;
    public int $id_commande;
    protected array $requiredFields = ['montant', 'date_paiement', 'type', 'id_commande'];
}
