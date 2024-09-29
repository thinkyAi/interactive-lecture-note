<?php

namespace App\controllers\lecturer;

use App\Contracts\AuthInterface;
use App\Contracts\RequestValidatorFactoryInterface;
use App\controllers\AuthController;
use App\Exception\ValidationException;
use App\helper\SetLecturerData;
use App\RequestValidators\LoginLecturerRequestValidator;
use App\RequestValidators\RegisterLecturerRequestValidator;
use App\RequestValidators\UserLoginRequestValidator;
use App\UserAuth\LecturerAuth;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class LecturerAuthController extends AuthController
{
    public function __construct(
        Twig $twig,
        RequestValidatorFactoryInterface $requestValidatorFactory,
        AuthInterface $auth,
        private readonly LecturerAuth $lecturerAuth,
        private readonly SetLecturerData $setLecturerData
    )
    {
        parent::__construct($twig, $requestValidatorFactory, $auth);
    }


    public function registerLecturer(Request $request, Response $response): Response
    {

        $data = $this->requestValidatorFactory->make(RegisterLecturerRequestValidator::class)->validate(
            $request->getParsedBody()
        );

         $this->lecturerAuth->registerLecturer(
            $this->setLecturerData->all($data)
         );

        return $response->withHeader('Location', '/')->withStatus(302);
    }

    public function logIn(Request $request, Response $response): Response
    {
        $data = $this->requestValidatorFactory->make(LoginLecturerRequestValidator::class)->validate(
            $request->getParsedBody()
        );

        if (! $this->lecturerAuth->attemptLogin($data)) {

            throw new ValidationException(['password' => ['You have entered an invalid username or password']]);
        }

        return $response->withHeader('Location', '/')->withStatus(302);
    }


}
