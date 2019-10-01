<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route; 
use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tqdev\PhpCrudApi\Api;
use Tqdev\PhpCrudApi\Config;

class UserController extends AbstractController
{
    const DB = ['username' => 'artmint', 'password' => 'sf4user', 'database' => 'sf4', 'basePath' => '/'];

    /**
     * @Route("/records/user", name="api_create_user", methods={"POST"})
     * @Route("/records/user", name="api_read_user", methods={"GET"})
     * @Route("/records/user/{id}", name="api_update_user", methods={"PUT"})
     * @Route("/records/user/{id}", name="api_delete_user", methods={"DELETE"})
     */
    public function apiAction(Request $symfonyRequest): Response
    {
        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
        $psrRequest = $psrHttpFactory->createRequest($symfonyRequest);

        $config = new Config(self::DB);
        $api = new Api($config);
        $psrResponse = $api->handle($psrRequest);

        $httpFoundationFactory = new HttpFoundationFactory();
        $symfonyResponse = $httpFoundationFactory->createResponse($psrResponse);

        return $symfonyResponse;
    } 
}
