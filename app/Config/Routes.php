<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->get('/', 'Home::index');
$routes->get('/', 'HomeController::index');
$routes->get('/about/company', 'Pages::about');
$routes->get('courses/detail/(:num)', 'CoursesController::detail/$1');
<<<<<<< HEAD
$routes->get('courses/search', 'CoursesController::search');
$routes->get('/trainer', 'TrainerController::trainer');
=======
$routes->get('about/web_policy', 'Pages::webPolicy');
>>>>>>> 26f0d794130b19c3d28bcc61e4df515b13ff50e7

// Auth Routes 
$routes->get('/register', 'Auth::register');
$routes->post('/register-process', 'Auth::registerProcess');
$routes->get('/login', 'Auth::login');
$routes->post('/login-process', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

// Protected Routes 
$routes->get('dashboard', 'CoursesController::dashboard', ['filter' => 'auth']);
$routes->get('courses/enrolled', 'CoursesController::enrolled', ['filter' => 'auth']);
$routes->get('courses/in-progress', 'CoursesController::inProgress', ['filter' => 'auth']);
$routes->get('courses/completed', 'CoursesController::completed', ['filter' => 'auth']);
$routes->get('courses/certificate/(:num)', 'CoursesController::certificate/$1', ['filter' => 'auth']);

// Trainer Menu
$routes->get('configure/trainee', 'TraineeController::index', ['filter' => 'auth']);
$routes->get('configure/trainee/search', 'TraineeController::search', ['filter' => 'auth']);
