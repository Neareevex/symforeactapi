<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class AuthController extends AbstractController
{
    private $jwtManager;

    public function __construct(JWTTokenManagerInterface $jwtManager)
    {
        $this->jwtManager = $jwtManager;
    }

    public function loginCheckAction(Request $request, UserRepository $userRepository)
    {
        $user = $userRepository->findOneBy(['email' => $request->request->get('_username')]);

        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        if (!password_verify($request->request->get('_password'), $user->getPassword())) {
            throw new BadCredentialsException();
        }

        $token = $this->jwtManager->create($user);

        $response = new Response();
        $response->headers->set('Authorization', 'Bearer '.$token);
        $response->headers->set('Access-Control-Expose-Headers', 'Authorization');
        return $response;
    }
}
