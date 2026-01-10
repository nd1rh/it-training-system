<?php

namespace App\Controllers;

use App\Models\TraineeModel;

class TraineeController extends BaseController
{
    public function index()
    {
        $model = new TraineeModel();
        $data['trainees'] = $model->getTraineesWithDetails(); // get all trainees with course/payment info

        echo view('templates/header');
        echo view('trainees_view', $data);
        echo view('templates/footer');
    }

    public function search()
    {
        $keyword = $this->request->getGet('keyword');
        $model = new TraineeModel();
        $trainees = $model->getTraineesWithDetails($keyword);

        return $this->response->setJSON($trainees);
    }
}
