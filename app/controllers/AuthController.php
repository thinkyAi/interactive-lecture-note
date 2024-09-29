<?php

namespace App\controllers;

use App\Contracts\AuthInterface;
use App\Contracts\RequestValidatorFactoryInterface;
use App\DataObjects\LecturerData;
use App\DataObjects\RegisterUserData;
use App\Exception\ValidationException;
use App\helper\SetLecturerData;
use App\RequestValidators\RegisterLecturerRequestValidator;
use App\RequestValidators\RegisterUserRequestValidator;
use App\RequestValidators\UserLoginRequestValidator;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class AuthController
{
    public function __construct(
        private readonly Twig                               $twig,
        protected readonly RequestValidatorFactoryInterface $requestValidatorFactory,
        protected readonly AuthInterface                    $auth,
    ) {
    }

    public function authView(Request $request, Response $response): Response
    {
        return $this->twig->render($response, 'auth/authenticate.twig');
    }

    public function registerView(Request $request, Response $response): Response
    {
        return $this->twig->render($response, 'auth/register.twig');
    }

    public function register(Request $request, Response $response)
    {
        $data = $this->requestValidatorFactory->make(RegisterLecturerRequestValidator::class)->validate(
            $request->getParsedBody()
        );

        var_dump($data);

        // $this->auth->register(
        //    $this->setLecturerData->all($data)
        // );

        //return $response->withHeader('Location', '/')->withStatus(302);
    }



    public function logOut(Request $request, Response $response): Response
    {
        $this->auth->logOut();

        return $response->withHeader('Location', '/')->withStatus(302);
    }

}