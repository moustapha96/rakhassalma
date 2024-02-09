<?php

namespace App\Api\Controller;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Client;
use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use App\Repository\VoitureRepository;
use App\Services\paytech\PaytechService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/api/', name: 'app_client_')]
class ApiReservationController extends AbstractController
{

    private $em;
    public  function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->em = $entityManagerInterface;
    }


    /** Paiement d'une reservation */
    #[Route('/reservation/{id}', name: 'reservation_paiement', methods: ['GET'])]
    public function paiementReservation(Reservation $reservation, ReservationRepository $reservationRepository): JsonResponse
    {
        // $station = $stationRepository->find($id);

        if (!$reservation) {
            return new JsonResponse(['message' => 'Reservation non trouvée'], 404);
        }

        dd($reservation);
        return new JsonResponse("Paiement reussie", 200);
    }

    #[Route('/reservation/{id}/paiement/', name: 'reservation_paiement', methods: ['GET'])]
    public function processPayment(
        PaytechService $paymentService,
        Reservation $reservation,
        ReservationRepository $reservationRepository
    ): JsonResponse {
        $paiement = $reservation->getPaiement();

        $requestData = [];

        // Traitement du paiement via le service
        $response = $paymentService->processPayment($requestData);

        // Retourner la réponse JSON
        return new JsonResponse($response, 200);
    }
}
