<?php

namespace App\Api\Controller;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Client;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/api/', name: 'app_client_')]
class ApiMethodClientController extends AbstractController
{

    private $em;
    public  function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->em = $entityManagerInterface;
    }


    #[Route('/client/{id}/voiture', name: 'client_voiture', methods: ['GET'])]
    public function listeVoiture(Client $client,  VoitureRepository $voitureRepository): ?Response
    {

        $voitures = $voitureRepository->findBy(['client' => $client]);

        return new JsonResponse($voitures, 200);
    }
}
