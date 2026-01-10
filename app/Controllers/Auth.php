<?php

namespace App\Controllers;

use App\Models\TraineeModel;
use App\Models\TrainerModel;

class Auth extends BaseController
{
    /* ===================== REGISTER ===================== */

    public function register()
    {
        echo view('templates/header');
        echo view('register_view');
        echo view('templates/footer');
    }

    public function registerProcess()
    {
        $rules = [
            'role'      => 'required|in_list[trainee,trainer]',
            'full_name' => 'required|min_length[2]',
            'email'     => 'required|valid_email',
            'password'  => 'required|min_length[8]',
            'gender'    => 'required|in_list[male,female]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $role = $this->request->getPost('role');

        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'gender'    => $this->request->getPost('gender')
        ];

        if ($role === 'trainee') {

            $traineeModel = new TraineeModel();

            // Check unique email
            if ($traineeModel->where('email', $data['email'])->first()) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['Email already registered as trainee']);
            }

            $data['phone_num'] = $this->request->getPost('phone_num');

            $traineeModel->insert($data);
            $userId = $traineeModel->getInsertID();
        } else {

            $trainerModel = new TrainerModel();

            // Check unique email
            if ($trainerModel->where('email', $data['email'])->first()) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['Email already registered as trainer']);
            }

            $trainerModel->insert($data);
            $userId = $trainerModel->getInsertID();
        }

        // Create session
        session()->set([
            'user_id'    => $userId,
            'full_name'  => $data['full_name'],
            'role'       => $role,
            'isLoggedIn' => true
        ]);

        return redirect()->to('/dashboard');
    }

    /* ===================== LOGIN ===================== */

    public function login()
    {
        echo view('templates/header');
        echo view('login_view');
        echo view('templates/footer');
    }

    public function loginProcess()
    {
        $role     = $this->request->getPost('role');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (!$role || !$email || !$password) {
            return redirect()->back()->with('error', 'All fields are required');
        }

        if ($role === 'trainee') {
            $model = new TraineeModel();
            $user  = $model->where('email', $email)->first();
        } else {
            $model = new TrainerModel();
            $user  = $model->where('email', $email)->first();
        }

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Invalid Email or Password');
        }

        session()->set([
            'user_id'    => $user[$role . '_id'],
            'full_name'  => $user['full_name'],
            'role'       => $role,
            'isLoggedIn' => true
        ]);

        return redirect()->to('/dashboard');
    }

    /* ===================== LOGOUT ===================== */

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
