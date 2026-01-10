<?php

namespace App\Controllers;

use App\Models\TrainerModel;

class TrainerProfileController extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id'); 
        $role   = $session->get('role');

        // Verify the user is logged in and is a trainer
        if (!$session->get('isLoggedIn') || $role !== 'trainer') {
            return redirect()->to('/login');
        }

        $model = new TrainerModel();
        $data['trainer'] = $model->find($userId);

        echo view('templates/header');
        echo view('trainer_profile_view', $data);
        echo view('templates/footer');
    }
}