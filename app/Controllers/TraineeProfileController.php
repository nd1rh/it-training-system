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

        if (!$session->get('isLoggedIn') || $role !== 'trainee') {
            return redirect()->to('/login');
        }

        $model = new TraineeModel();
        $data['trainee'] = $model->find($userId);

        echo view('templates/header');
        echo view('trainee_profile_view', $data);
        echo view('templates/footer');
    }

    public function edit_profile()
    {
        $session = session();
        $userId = $session->get('user_id');
        $role   = $session->get('role');

        if (!$session->get('isLoggedIn') || $role !== 'trainee') {
            return redirect()->to('/login');
        }

        $model = new TraineeModel();
        $data['trainee'] = $model->find($userId);

        echo view('templates/header');
        echo view('trainee_edit_profile', $data);
        echo view('templates/footer');
    }

    public function update_profile()
    {
        $traineeModel = new \App\Models\TraineeModel();
        $session = session();
        $traineeId = $session->get('user_id');

        $data = [
            'full_name'     => $this->request->getPost('full_name'),
            'email'         => $this->request->getPost('email'),
            'phone_num'     => $this->request->getPost('phone_number'), 
            'date_of_birth' => $this->request->getPost('dob'),    
            'gender'        => $this->request->getPost('gender')
        ];

        $newPassword = $this->request->getPost('password');
        if (!empty($newPassword)) {
            if (strlen($newPassword) < 8) {
                return redirect()->back()->with('error', 'Password must be at least 8 characters long.');
            }
            $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $file = $this->request->getFile('profile_pic');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/trainees', $newName);
            $data['profile_pic'] = 'uploads/trainees/' . $newName;
        }

        if ($traineeModel->update($traineeId, $data)) {
            return redirect()->to('trainee/profile')->with('success', 'Profile updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Database update failed.');
        }
    }

    public function uploadPhoto()
    {
        $session = session();
        $userId = $session->get('user_id');

        $file = $this->request->getFile('profile_pic');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();

            $file->move(FCPATH . 'uploads/trainees/', $newName);
            $savePath = 'uploads/trainees/' . $newName;

            $model = new TraineeModel();
            $model->update($userId, ['profile_pic' => $savePath]);

            return redirect()->back()->with('success', 'Photo updated successfully!');
        }

        return redirect()->back()->with('error', 'Invalid file upload.');
    }
}
