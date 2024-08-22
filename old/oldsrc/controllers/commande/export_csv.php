<?php

require_once('src/model/commande.php');

class ExportCSV
{
    public function execute()
    {
        $connection = new DatabaseConnection();
        $fichier = 'data.csv';
        $chemin = "./data.csv";
        $fp = fopen($fichier, 'w');
        $statement = $connection->getConnection()->query(
            "SELECT * FROM commande ORDER BY id_commande"
        );
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($rows as $row) {
            if(fputcsv($fp, $row) === false) {
                die('Can\'t write line');
            }
        }
        fclose($fp);
        header('Content-disposition: attachment; filename="' . $fichier . '"');
        header('Content-Type: application/force-download');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($chemin));
        header('Pragma: no-cache');
        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        readfile($chemin);
        //header("Location: index.php");
    }
}
