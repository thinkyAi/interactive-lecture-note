<?php

declare(strict_types = 1);

use App\Controllers\AuthController;
use App\controllers\CourseController;
use App\Controllers\HomeController;
use App\controllers\lecturer\LecturerAuthController;
use App\controllers\lecturer\LecturerHomeController;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->get('/', [LecturerHomeController::class, 'index'])->add(AuthMiddleware::class);

    $app->group('/auth', function (RouteCollectorProxy $guest) {
       $guest->get('', [LecturerAuthController::class, 'authView']);
       $guest->post('/login', [LecturerAuthController::class, 'logIn']);
       $guest->post('/register/lecturer', [LecturerAuthController::class,  'registerLecturer']);
    })->add(GuestMiddleware::class);

    $app->group('/course', function (RouteCollectorProxy $course){
        $course->get('', [CourseController::class, 'index']);
        $course->get('/fetch-by-level-and-semester', [CourseController::class, 'getByLevelAndSemester']);
        $course->get('/create', [CourseController::class, 'createView']);
        $course->post('/create', [CourseController::class, 'register']);
        $course->get('/load', [CourseController::class, 'load']);
    })->add(AuthMiddleware::class);

    $app->post('/logout', [AuthController::class, 'logOut'])->add(AuthMiddleware::class);

    //$app->group('/categories', function (RouteCollectorProxy $categories) {
        
    //})->add(AuthMiddleware::class);



};
