<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/coding')]
    public function home(): Response
    {
        $skills = [
            ['name' => 'php', 'version' => 8.2],
            ['name' => 'laravel', 'version' => 9.2],
            ['name' => 'symfony', 'version' => 6],
        ];
        return $this->render('home.html.twig', [
            'title' => 'Home',
            'skills' => $skills
        ]);
    }

    #[Route('/users/{user}')]
    #wildcard params call in the method are optional
    #params order is not important
    public function users(String $user = null): Response
    {
        if ($user) {
            $title = str_replace('-', ' ', $user);
        } else {
            $title = 'all users';
        }

        return new Response("Welcome $title");
    }
}
