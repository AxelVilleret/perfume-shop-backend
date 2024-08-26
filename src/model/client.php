<?php

require_once 'src/model/Entity.php';

class Client extends Entity
{
    public string $nom;
    public string $adresse;
    public string $email;
    public string $telephone;
    public string $facebook;
    public string $instagram;
    public int $id_membership = 1;
    protected array $requiredFields = ['nom', 'adresse', 'email', 'telephone'];
    
}