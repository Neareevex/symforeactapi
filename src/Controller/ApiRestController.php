<?php

namespace App\Controller;

use App\Repository\UserRepository;
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

    /**
     * @Route("/api/users", name="app_api_list-user")
     */
    public function listUsers(UserRepository $userRepository) {
        $users = $userRepository->findAll();
        dump($users);
        return $users;
    }
}
