<?php

require_once('src/model/Commande.php');
require_once('src/repositories/CommandeRepository.php');
require_once('src/services/ShowCommandesByUserIdService.php');
require_once('src/services/DownloadCommandesService.php');

class ExportCommandesUC
{
    private IService $downloadCommandesService;

    public function execute($userId)
    {
        $this->downloadCommandesService = new DownloadCommandesService(new ShowCommandesByUserIdService(new CommandeRepository(), $userId));
        $this->downloadCommandesService->execute();
    }
}