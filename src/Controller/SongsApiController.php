<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SongsApiController extends AbstractController
{
   #[Route('/api/songs/{id<\d+>}',methods:['GET'])]
    public function getSong(int $id): Response
    {
        $song = [
            'id' => $id,
            'song' => 'Gangsta\'s Paradise',
            'artist' => 'Coolio'
        ];
        // shortcut 
        //   return $this->json($song);
        return new JsonResponse($song);
    }
}
