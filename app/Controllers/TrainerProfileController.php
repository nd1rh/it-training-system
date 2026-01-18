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

        if (!$session->get('isLoggedIn') || $role !== 'trainer') {
            return redirect()->to('/login');
        }

        $model = new TrainerModel();

        $data['trainer'] = $model->where('trainer_id', $userId)->first();

        if (!$data['trainer']) {
            return redirect()->to('/login')->with('error', 'Profile not found.');
        }

        echo view('templates/header');
        echo view('trainer_profile_view', $data);
        echo view('templates/footer');
    }

    public function update_profile()
    {
        $session = session();
        $trainerId = $session->get('user_id');

        $file = $this->request->getFile('profile_pic');
        $profilePicPath = $this->request->getPost('old_pic'); 

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/trainers/', $newName);
            $profilePicPath = 'uploads/trainers/' . $newName;
        }

        $updateData = [
            'full_name'        => $this->request->getPost('full_name'),
            'email'            => $this->request->getPost('email'),
            'phone_number'     => $this->request->getPost('phone_number'),
            'gender'           => $this->request->getPost('gender'),
            'specialization'   => $this->request->getPost('specialization'),
            'experience_years' => $this->request->getPost('experience_years'),
            'profile_pic'      => $profilePicPath
        ];

        $newPassword = $this->request->getPost('password');
        if (!empty($newPassword)) {
            if (strlen($newPassword) < 8) {
                return redirect()->back()->with('error', 'Password must be at least 8 characters long.');
            }
            $updateData['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $trainerModel = new TrainerModel();

        if ($trainerModel->update($trainerId, $updateData)) {
            return redirect()->to('/trainer/profile')->with('success', 'Profile updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update profile.');
        }
    }

    public function edit_profile()
    {
        $session = session();
        $userId = $session->get('user_id');

        $model = new TrainerModel();
        $data['trainer'] = $model->where('trainer_id', $userId)->first();

        if (!$data['trainer']) {
            return redirect()->to('/trainer/profile')->with('error', 'Trainer not found.');
        }

        echo view('templates/header');
        echo view('trainer_edit_profile', $data);
        echo view('templates/footer');
    }

    public function uploadPhoto()
    {
        $session = session();
        $userId = $session->get('user_id');

        $file = $this->request->getFile('profile_pic');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/profile_pics', $newName);

            $model = new \App\Models\TrainerModel();
            $model->update($userId, ['profile_pic' => $newName]);

            return redirect()->back()->with('success', 'Photo updated successfully!');
        }

        return redirect()->back()->with('error', 'Invalid file upload.');
    }
}
