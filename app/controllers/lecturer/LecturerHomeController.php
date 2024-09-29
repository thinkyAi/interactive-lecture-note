<?php

namespace App\controllers\lecturer;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class LecturerHomeController
{
    public function __construct(private readonly Twig $twig)
    {
    }

    public function index(Request $request, Response $response): Response
    {
        return $this->twig->render($response, 'dashboard.twig');
    }

}