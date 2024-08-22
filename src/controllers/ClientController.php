<?php

require_once('src/lib/database.php');
require_once('src/model/client.php');
require_once('src/controllers/Controller.php');

class ClientController extends Controller
{
    private $clientRepository;

    public function __construct()
    {
        $this->clientRepository = new ClientRepository(new DatabaseConnection());
    }

    protected function getAll()
    {
        $clients = $this->clientRepository->getClients();
        echo json_encode($clients);
    }
}