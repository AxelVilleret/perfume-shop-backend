<?php

class Facture {
    public int $id_facture;
    public string $date_creation;
    public string $date_mise_a_jour;
    public float $montant;
    public int $id_commande;
}