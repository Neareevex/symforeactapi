<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PublicationRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/")
 */
class ApiRestController extends AbstractController
{
    /**
     * @Route("rest", name="app_api_rest")
     */
    public function index(): Response
    {
        return $this->render('api_rest/index.html.twig', [
            'controller_name' => 'ApiRestController',
        ]);
    }

    /**
     * @Route("users", name="app_api_list-user")
     */
    public function listUsers(UserRepository $userRepository) {
        $users = $userRepository->findAll();
        dump($users);
        return $users;
    }

    /**
     * @Route("publications", name="app_api_list-publications")
     */
    public function listPublications(PublicationRepository $publicationRepository, SerializerInterface $serializer) {
        $publications = $publicationRepository->findAll();
          // to get json encoding error
        //    echo json_last_error_msg(); // Print out the error if any
        //    die();
        $jsonContent = $serializer->serialize($publications, 'json', [
            'groups' => ['read'],
        ]);
        $response =  new Response($jsonContent, 200, [
            'Content-Type' => 'application/json',
        ]);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
