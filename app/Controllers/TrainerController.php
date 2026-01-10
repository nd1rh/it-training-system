<?php

namespace App\Controllers;

use App\Models\TrainerModel;
use CodeIgniter\Controller;

class TrainerController extends BaseController
{
    protected $trainerModel;

    public function __construct()
    {
        $this->trainerModel = new TrainerModel();
    }

    // Public Trainer Listing
    public function trainer()
    {
        // Fetch all trainers from database
        $trainers = $this->trainerModel->findAll();

        $data = [
            'trainers' => $trainers
        ];

        // Load the public trainer view
        echo view('templates/header'); // optional
        echo view('trainer_view', $data);
        echo view('templates/footer'); // optional
    }

    public function myProfile()
    {
        $session = session();
        $trainerId = $session->get('trainer_id'); // Ensure trainer_id is set during login

        if (!$trainerId) {
            return redirect()->to('/login');
        }

        $model = new TrainerModel();
        $data['trainer'] = $model->getTrainerProfile($trainerId);

        echo view('templates/header');
        echo view('trainer_profile_view', $data);
        echo view('templates/footer');
    }
}
