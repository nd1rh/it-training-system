<?php

namespace App\Controllers;

use App\Models\TraineeModel;

class TraineeProfileController extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');
        $role   = $session->get('role');

        // Security check: must be logged in and must be a trainee
        if (!$session->get('isLoggedIn') || $role !== 'trainee') {
            return redirect()->to('/login');
        }

        $model = new TraineeModel();
        $data['trainee'] = $model->find($userId);

        echo view('templates/header');
        echo view('trainee_profile_view', $data);
        echo view('templates/footer');
    }

    public function uploadPhoto()
    {
        $file = $this->request->getFile('profile_pic');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/profile_pics', $newName);

            $model = new TraineeModel();
            $model->update(session()->get('user_id'), ['profile_pic' => $newName]);

            return redirect()->back()->with('success', 'Photo updated!');
        }
        return redirect()->back()->with('error', 'Upload failed.');
    }
}