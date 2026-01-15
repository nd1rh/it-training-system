<?php

namespace App\Controllers;

class TrainerDashboardController extends BaseController
{
    public function index()
    {
        echo view('templates/header');
        echo view('trainerdashboard_view');
        echo view('templates/footer');
    }
}
