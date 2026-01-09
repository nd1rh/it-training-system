<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        echo view('templates/header');
        echo view('register_view');
        echo view('templates/footer');
    }

    public function registerProcess()
    {
        // 1. Validation Rules
        $rules = [
            'full_name' => 'required|min_length[2]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'profile_image' => 'max_size[profile_image,2048]|is_image[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png]',
            'role' => 'required|in_list[trainee,admin]',
            'gender' => 'required|in_list[male,female]'
        ];

        // 2. Check Validation
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 3. Handle Profile Image Upload
        $imageName = null;
        $imageFile = $this->request->getFile('profile_image');

        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'assets/images', $imageName);
        }

        // 4. Prepare Data
        $userModel = new UserModel();
        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'), // Save selected role
            'phone_num' => $this->request->getPost('phone_num'),
            'gender' => $this->request->getPost('gender'),
            'profile_image' => $imageName
        ];

        // 5. Save User
        $userModel->save($data);

        // 6. Set Session
        session()->set([
            'user_id' => $userModel->getInsertID(),
            'username' => $data['full_name'],
            'role' => $data['role'],
            'profile_image' => $data['profile_image'],
            'isLoggedIn' => true
        ]);

        return redirect()->to('/dashboard');
    }

    public function login()
    {
        echo view('templates/header');
        echo view('login_view');
        echo view('templates/footer');
    }

    public function loginProcess()
    {
        $role = $this->request->getPost('role');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->where('role', $role)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id' => $user['user_id'],
                'username' => $user['full_name'],
                'role' => $user['role'],
                'profile_image' => $user['profile_image'],
                'isLoggedIn' => true
            ]);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Invalid Role, Email or Password');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}