<?php

require_once('src/uc/ExportCommandesUC.php');
require_once('src/controllers/Controller.php');

class ExportcommandesController extends Controller
{
    private ExportCommandesUC $exportCommandes;

    public function __construct()
    {
        $this->exportCommandes = new ExportCommandesUC();
    }

    public function execute($query, $instance, $method)
    {
        if ($method !== 'GET') {
            throw new Exception("Invalid request method.");
        }  
        if (!isset($query['id'])) {
            throw new Exception("Missing id parameter.");
        }
        if (filter_var($query['id'], FILTER_VALIDATE_INT) === false) {
            throw new Exception("Invalid id parameter.");
        }
        $this->exportCommandes->execute($query['id']);  
    }
}