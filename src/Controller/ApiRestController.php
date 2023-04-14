<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiRestController extends AbstractController
{
    /**
     * @Route("/api/rest", name="app_api_rest")
     */
    public function index(): Response
    {
        return $this->render('api_rest/index.html.twig', [
            'controller_name' => 'ApiRestController',
        ]);
    }
}
