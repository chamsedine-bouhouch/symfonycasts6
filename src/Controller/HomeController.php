<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    #[Route('/')]
    public function home(): Response
    {
        return new Response('title: done');
    }

    #[Route('/users/{user}')]
    #wildcard params call in the method are optional
    #params order is not important
    public function users(String $user= null): Response
    {
        if ($user) {
            $title=str_replace('-',' ',$user);
        } else {
            $title='all users';
        }
        
        return new Response("Welcome $title");
    }
}
