<?php

namespace App\Controllers;

use App\Models\CourseEnrollmentModel;
use App\Models\CourseModel;

class HomeController extends BaseController
{
    public function index()
    {
        $enrollModel = new CourseEnrollmentModel();
        $courseModel = new CourseModel();

        // Count courses
        $data['courses_enrolled'] = $enrollModel->where('trainee_id', session()->get('user_id'))->countAllResults();
        $data['courses_in_progress'] = $enrollModel->where('trainee_id', session()->get('user_id'))
            ->where('status', 'In Progress')->countAllResults();
        $data['courses_completed'] = $enrollModel->where('trainee_id', session()->get('user_id'))
            ->where('status', 'Completed')->countAllResults();

        // Get 8 available courses
        $data['available_courses'] = $courseModel->limit(8)->findAll();

        echo view('templates/header');
        echo view('home_view', $data);
        echo view('templates/footer');
    }
}
