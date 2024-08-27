<?php

require_once('src/model/Commande.php');
require_once('src/repositories/CommandeRepository.php');
require_once('src/services/ShowCommandesService.php');
require_once('src/services/DownloadCommandesService.php');
require_once('src/uc/ExportCommandes.php');
require_once('src/controllers/Controller.php');

class ExportcommandesController extends Controller
{
    private IUseCase $exportCommandes;

    public function __construct()
    {
        $commandeRepository = new CommandeRepository();
        $showCommandesService = new ShowCommandesService($commandeRepository);
        $downloadCommandesService = new DownloadCommandesService($showCommandesService);
        $this->exportCommandes = new ExportCommandes($downloadCommandesService);
    }

    public function execute($query, $instance, $method)
    {
        if ($method !== 'GET') {
            throw new Exception("Invalid request method.");
        }  
        $this->exportCommandes->execute();  
    }
}