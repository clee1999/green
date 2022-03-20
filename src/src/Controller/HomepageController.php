<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function main(): Response
    {
        return $this->render('homepage/main.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return $this->render('homepage/homepage.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

}
