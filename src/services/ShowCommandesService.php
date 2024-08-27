<?php

require_once('src/services/IService.php');

class ShowCommandesService implements IService
{
    private IRepository $commandeRepository;

    public function __construct(IRepository $commandeRepository)
    {
        $this->commandeRepository = $commandeRepository;
    }

    public function execute()
    {
        return $this->commandeRepository->getAll();
    }
}