<?php

namespace App\Api\Controller;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Client;
use App\Entity\Station;
use App\Repository\StationRepository;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/api/', name: 'app_client_')]
class ApiStationController extends AbstractController
{

    private $em;
    public  function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->em = $entityManagerInterface;
    }


    /*Lister les stations de lavage */
    #[Route('/stations', name: 'liste_stations', methods: ['GET'])]
    public function listStations(StationRepository $stationRepository): ?Response
    {
        $stations = $stationRepository->findAll();
        return new JsonResponse($stations, 200);
    }

    /**Lister les stations les plus proches  */
    #[Route('/stations/proximite', name: 'stations_proximite', methods: ['POST'])]

    public function getProximiteStation(Request $request, StationRepository $stationRepository): ?JsonResponse
    {
        $latitude = $request->query->get('latitude');
        $longitude = $request->query->get('longitude');

        $stations = $stationRepository->findAll();
        $nearestStations = [];

        return new JsonResponse($nearestStations, 200);
    }
}
