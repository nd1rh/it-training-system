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

    public function uploadPhoto()
    {
        $session = session();
        $userId = $session->get('user_id');

        $file = $this->request->getFile('profile_pic');

        if ($file->isValid() && !$file->hasMoved()) {
            // Generate a unique name to avoid overwriting
            $newName = $file->getRandomName();

            // Move file to public/uploads/profile_pics
            $file->move(ROOTPATH . 'public/uploads/profile_pics', $newName);

            $model = new \App\Models\TrainerModel();
            $model->update($userId, ['profile_pic' => $newName]);

            return redirect()->back()->with('success', 'Photo updated successfully!');
        }

        return redirect()->back()->with('error', 'Invalid file upload.');
    }
}
