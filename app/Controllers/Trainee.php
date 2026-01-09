<?php
namespace App\Controllers;
use App\Models\TraineeModel;

class Trainee extends BaseController
{
    public function index()
    {
        $model = new TraineeModel();
        
        // Fetch only users who are trainees
        $data['trainees'] = $model->where('role', 'Trainee')->findAll();

        echo view('templates/header'); // Assuming your header is a separate view
        echo view('trainees_view', $data);
        echo view('templates/footer');
    }
}