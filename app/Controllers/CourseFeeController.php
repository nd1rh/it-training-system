<?php

namespace App\Controllers;

use App\Models\CourseFeeModel;

class CourseFeeController extends BaseController
{
    /**
     * Display the list of all courses and their fees
     */
    public function index()
    {
        // Make sure you are using CourseFeeModel
        $model = new CourseFeeModel();

        // Change this from $model->findAll() to:
        $data['courses'] = $model->getCoursesWithFees();

        echo view('templates/header');
        echo view('course_fee_view', $data);
        echo view('templates/footer');
    }

    /**
     * Search for specific courses via AJAX or API
     * Returns results in JSON format
     */
    public function search()
    {
        $keyword = $this->request->getGet('keyword');
        $model = new CourseFeeModel();

        // Searching by course name or description
        $courses = $model->like('course_name', $keyword)
            ->orLike('course_desc', $keyword)
            ->findAll();

        return $this->response->setJSON($courses);
    }
}
