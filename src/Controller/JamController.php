<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request; // Import Request
use Symfony\Component\Routing\Annotation\Route; // Correct annotation import
use App\Service\GoogleMapsService;

class JamController extends AbstractController
{
    private $googleMapsService;

    public function __construct(GoogleMapsService $googleMapsService) {
        $this->googleMapsService = $googleMapsService;
    }

    /**
     * @Route("/api/maps", name="get_place", methods={"GET"})
     */
    public function getPlace(Request $request): JsonResponse
    {
        $query = $request->query->get('query', ''); 

        if (empty($query)) {
            return new JsonResponse(['error' => 'Query parameter is missing'], Response::HTTP_BAD_REQUEST);
        }

        $result = $this->googleMapsService->findPlaceFromText($query);

        return new JsonResponse($result);
    }
}
