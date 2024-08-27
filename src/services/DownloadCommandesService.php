<?php

require_once('src/services/IService.php');

class DownloadCommandesService implements IService
{
    
    private IService $commandesService;
    private string $file = 'data.csv';
    private string $path;

    public function __construct(IService $commandesService)
    {
        $this->commandesService = $commandesService;
        $this->path = './' . $this->file;
    }

    public function execute()
    {
        $commandes = $this->getCommandes();
        $this->writeCsv($commandes);
        $this->downloadCsv();
        
    }

    private function getCommandes()
    {
        return $this->commandesService->execute();
    }

    private function writeCsv($commandes)
    {
        $fp = fopen($this->file, 'w');

        foreach ($commandes as $commande) {
            $commandeArray = $this->objectToArray($commande, ['requiredFields']);
            if (fputcsv($fp, $commandeArray) === false) {
                die('Can\'t write line');
            }
        }

        fclose($fp);
    }

    private function downloadCsv()
    {
        header('Content-disposition: attachment; filename="' . $this->file . '"');
        header('Content-Type: application/force-download');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($this->path));
        header('Pragma: no-cache');
        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        readfile($this->path);
    }

    private function objectToArray($object, $exclude = [])
    {
        $array = [];
        foreach ($object as $key => $value) {
            if (!in_array($key, $exclude)) {
                $array[$key] = $value;
            }
        }
        return $array;
    }
}