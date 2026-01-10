<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->get('/', 'Home::index');
$routes->get('/', 'HomeController::index');
$routes->get('courses/enrolled', 'CoursesController::enrolled');
$routes->get('courses/in-progress', 'CoursesController::inProgress');
$routes->get('courses/completed', 'CoursesController::completed');
$routes->get('courses/detail/(:num)', 'CoursesController::detail/$1');
$routes->get('/about', 'Pages::about');

// Auth Routes 
$routes->get('/register', 'Auth::register');
$routes->post('/register-process', 'Auth::registerProcess');
$routes->get('/login', 'Auth::login');
$routes->post('/login-process', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

// Protected Routes 
$routes->get('/dashboard', 'Pages::dashboard', ['filter' => 'auth']);

// Trainee Routes
$routes->get('configure/trainee', 'TraineeController::index');
$routes->get('configure/trainee/search', 'TraineeController::search');