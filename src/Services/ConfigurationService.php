<?php


namespace App\Services;

use App\Entity\Parametre;
use Doctrine\ORM\EntityManagerInterface;

class ConfigurationService
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function get(string $key)
    {
        $config = $this->entityManager
            ->getRepository(Parametre::class)
            ->findOneBy(['cle' => $key]);

        if (!$config) {
            throw new \Exception(sprintf('Configuration "%s" not found.', $key));
        }
        return $config->getValeur();
    }
}
