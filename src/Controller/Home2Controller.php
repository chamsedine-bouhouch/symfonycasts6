<?php

namespace App\Controller;

use Psr\Cache\CacheItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

class Home2Controller extends AbstractController
{

    #[Route("/", name: "app_homepage")]
    public function homepage(): Response
    {
        $tracks = [
            ['song' => 'Gangsta\'s Paradise', 'artist' => 'Coolio'],
            ['song' => 'Waterfalls', 'artist' => 'TLC'],
            ['song' => 'Creep', 'artist' => 'Radiohead'],
            ['song' => 'Kiss from a Rose', 'artist' => 'Seal'],
            ['song' => 'On Bended Knee', 'artist' => 'Boyz II Men'],
            ['song' => 'Fantasy', 'artist' => 'Mariah Carey'],
        ];
        return $this->render('home2.html.twig', [
            'title' => 'PB & Jams',
            'tracks' => $tracks
        ]);
    }

    #[Route("/browse/{slug}", name: "app_browse")]
    public function browse(CacheInterface $cache, HttpClientInterface $http, string $slug = null): Response
    {
        $genre = $slug ? str_replace('-', ' ', $slug) : null;
        // $mixes = $this->getMixes();
        $mixes = $cache->get('mixes_data', function (CacheItemInterface $cache) use ($http) {
            $cache->expiresAfter(5);
            $response = $http->request('GET', 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');
            return $response->toArray();
        });

        return $this->render('browse.html.twig', [
            'genre' => $genre,
            'mixes' => $mixes,
        ]);
    }
    // private function getMixes(): array
    // {
    //     // temporary fake "mixes" data
    //     return [
    //         [
    //             'title' => 'PB & Jams',
    //             'trackCount' => 14,
    //             'genre' => 'Rock',
    //             'createdAt' => new \DateTime('2021-10-02'),
    //         ],
    //         [
    //             'title' => 'Put a Hex on your Ex',
    //             'trackCount' => 8,
    //             'genre' => 'Heavy Metal',
    //             'createdAt' => new \DateTime('2022-04-28'),
    //         ],
    //         [
    //             'title' => 'Spice Grills - Summer Tunes',
    //             'trackCount' => 10,
    //             'genre' => 'Pop',
    //             'createdAt' => new \DateTime('2019-06-20'),
    //         ],
    //     ];
    // }
}
