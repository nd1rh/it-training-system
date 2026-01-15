<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// public Routes
$routes->get('/', 'HomeController::index');
$routes->get('/about/company', 'Pages::about');
$routes->get('about/web_policy', 'Pages::webPolicy');
$routes->get('courses/detail/(:num)', 'CoursesController::detail/$1');
$routes->get('courses/search', 'CoursesController::search');
$routes->get('/trainer', 'TrainerController::trainer');
$routes->get('directory/course', 'HomeController::index');
$routes->get('directory/trainer', 'TrainerController::trainer');

// Auth Routes 
$routes->get('/register', 'Auth::register');
$routes->post('/register-process', 'Auth::registerProcess');
$routes->get('/login', 'Auth::login');
$routes->post('/login-process', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

// Protected Routes 
$routes->get('trainer/dashboard', 'TrainerDashboardController::index', ['filter' => ['auth', 'trainer']]);
$routes->get('trainee/dashboard', 'CoursesController::dashboard', ['filter' => ['auth', 'trainee']]);
$routes->get('courses/enrolled', 'CoursesController::enrolled', ['filter' => 'auth']);
$routes->get('courses/in-progress', 'CoursesController::inProgress', ['filter' => 'auth']);
$routes->get('courses/completed', 'CoursesController::completed', ['filter' => 'auth']);
$routes->get('courses/certificate/(:num)', 'CoursesController::certificate/$1', ['filter' => 'auth']);
$routes->post('courses/updateProgress/(:num)', 'CoursesController::updateProgress/$1', ['filter' => 'auth']);

// Trainer Menu
$routes->get('configure/trainee', 'TraineeController::index', ['filter' => 'auth']);
$routes->get('configure/trainee/search', 'TraineeController::search', ['filter' => 'auth']);
$routes->get('configure/trainee/edit/(:num)', 'TraineeController::edit/$1', ['filter' => 'auth']);
$routes->post('configure/trainee/update/(:num)', 'TraineeController::update/$1', ['filter' => 'auth']);
$routes->get('configure/trainee/delete/(:num)', 'TraineeController::delete/$1', ['filter' => 'auth']);

// Course Fee Menu
$routes->get('configure/course', 'ManageCourseController::index', ['filter' => 'auth']);
$routes->get('configure/course/search', 'ManageCourseController::search', ['filter' => 'auth']);
$routes->get('configure/course/edit/(:num)', 'ManageCourseController::edit/$1', ['filter' => 'auth']);
$routes->post('configure/course/update/(:num)', 'ManageCourseController::update/$1', ['filter' => 'auth']);
$routes->get('configure/course/delete/(:num)', 'ManageCourseController::delete/$1', ['filter' => 'auth']);

// Trainer Profile Route
$routes->get('trainer/profile', 'TrainerProfileController::index', ['filter' => 'auth']);
$routes->get('trainerprofile', 'TrainerProfileController::index', ['filter' => 'auth']);
$routes->get('trainer/edit_profile', 'TrainerProfileController::edit_profile', ['filter' => 'auth']);
$routes->post('trainer/update_profile', 'TrainerProfileController::update_profile', ['filter' => 'auth']);

// Trainee Profile Route
$routes->get('trainee/profile', 'TraineeProfileController::index', ['filter' => 'auth']);
$routes->get('traineeprofile', 'TraineeProfileController::index', ['filter' => 'auth']);
$routes->get('trainee/edit_profile', 'TraineeProfileController::edit_profile', ['filter' => 'auth']);
$routes->post('trainee/update_profile', 'TraineeProfileController::update_profile', ['filter' => 'auth']);

$routes->get('enroll/(:num)', 'EnrollmentController::enroll/$1', ['filter' => 'auth']);
$routes->get('payment/(:num)', 'PaymentController::index/$1', ['filter' => 'auth']);
$routes->post('payment/process', 'PaymentController::process', ['filter' => 'auth']);
$routes->get('enrolled', 'EnrollmentController::enrolledCourses', ['filter' => 'auth']);