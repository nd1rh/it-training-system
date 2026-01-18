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

    public function trainer()
    {
        $rows = $this->trainerModel->getTrainersWithCourses();

        $trainers = [];

        foreach ($rows as $row) {
            $id = $row['trainer_id'];

            if (!isset($trainers[$id])) {
                $trainers[$id] = [
                    'trainer_id' => $row['trainer_id'],
                    'full_name' => $row['full_name'],
                    'email' => $row['email'],
                    'specialization' => $row['specialization'],
                    'experience_years' => $row['experience_years'],
                    'profile_pic' => $row['profile_pic'],
                    'courses' => []
                ];
            }

            if (!empty($row['course_name'])) {
                $trainers[$id]['courses'][] = $row['course_name'];
            }
        }

        echo view('templates/header');
        echo view('trainer_view', ['trainers' => $trainers]);
        echo view('templates/footer');
    }

    public function myProfile()
    {
        $session = session();
        $trainerId = $session->get('trainer_id');

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
