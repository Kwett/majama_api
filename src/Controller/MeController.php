<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class MeController extends AbstractController {

    #[Route('/api/me', name: 'api_me', methods: ['GET'])]
    public function me()
    {
        $user = $this->getUser();
        
        if (!$user) {
            return new JsonResponse(['error' => 'User not authenticated'], 401);
        }

        return new JsonResponse([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            // Ajoutez ici d'autres informations sur l'utilisateur que vous souhaitez exposer
        ]);
    }
}