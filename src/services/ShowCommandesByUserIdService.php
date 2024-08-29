<?php

require_once('src/services/IService.php');

class ShowCommandesByUserIdService implements IService
{
    private IRepository $commandeRepository;
    private int $userId;

    public function __construct(IRepository $commandeRepository, $userId)
    {
        $this->commandeRepository = $commandeRepository;
        $this->userId = $userId;
    }

    public function execute()
    {
        return array_filter($this->commandeRepository->getAll(), function($commande) {
            return $commande->id_client === $this->userId;
        });
    }
}