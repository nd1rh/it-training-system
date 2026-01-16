<?php

namespace App\Controllers;

use App\Models\CourseModel;

class HomeController extends BaseController
{
    public function index()
    {
        $courseModel = new CourseModel();

        $data['available_courses'] = $courseModel->findAll();

        echo view('templates/header');
        echo view('home_view', $data);
        echo view('templates/footer');
    }
}
