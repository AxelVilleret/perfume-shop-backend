<?php

require_once('src/model/Client.php');
require_once('src/controllers/Controller.php');

class ClientController extends Controller
{

    public function __construct()
    {
        $this->repository = new ClientRepository();
    }

    
}