<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->get('/', 'Home::index');
$routes->get('/', 'Pages::index');
$routes->get('/about', 'Pages::about');
$routes->get('/contact', 'Pages::contact');

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