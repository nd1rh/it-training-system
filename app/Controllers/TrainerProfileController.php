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

        // 1. Verify the user is logged in and is a trainer
        if (!$session->get('isLoggedIn') || $role !== 'trainer') {
            return redirect()->to('/login');
        }

        // 2. Fetch the data (This is the 'profile' logic you asked for)
        $model = new TrainerModel();

        // Use find($userId) if your primary key is trainer_id, 
        // or where('trainer_id', $userId)->first() to be specific.
        $data['trainer'] = $model->where('trainer_id', $userId)->first();

        // 3. Handle case where trainer is not found in database
        if (!$data['trainer']) {
            return redirect()->to('/login')->with('error', 'Profile not found.');
        }

        // 4. Render the views
        echo view('templates/header');
        echo view('trainer_profile_view', $data);
        echo view('templates/footer');
    }

    public function update_profile()
    {
        $session = session();
        $trainerId = $session->get('user_id'); // Get ID from session

        $file = $this->request->getFile('profile_pic');
        $profilePicPath = $this->request->getPost('old_pic'); // Keep current if no new upload

        // Handle Image Upload
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            // Consistent path: uploads/trainers/
            $file->move(FCPATH . 'uploads/trainers/', $newName);
            $profilePicPath = 'uploads/trainers/' . $newName;
        }

        // Data from Form
        $updateData = [
            'full_name'        => $this->request->getPost('full_name'),
            'email'            => $this->request->getPost('email'),
            'phone_number'     => $this->request->getPost('phone_number'),
            'gender'           => $this->request->getPost('gender'),
            'specialization'   => $this->request->getPost('specialization'),
            'experience_years' => $this->request->getPost('experience_years'),
            'profile_pic'      => $profilePicPath
        ];

        // Handle Password Update (if provided)
        $newPassword = $this->request->getPost('password');
        if (!empty($newPassword)) {
            // Validate password length
            if (strlen($newPassword) < 8) {
                return redirect()->back()->with('error', 'Password must be at least 8 characters long.');
            }
            // Hash the new password
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
        echo view('trainer_edit_profile', $data); // Make sure your edit file is named this
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
