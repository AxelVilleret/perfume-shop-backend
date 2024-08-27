<?php

require_once('src/uc/IUseCase.php');

class ExportCommandes implements IUseCase
{
    private IService $downloadCommandesService;

    public function __construct(IService $downloadCommandesService)
    {
        $this->downloadCommandesService = $downloadCommandesService;
    }

    public function execute()
    {
        $this->downloadCommandesService->execute();
    }

    


}