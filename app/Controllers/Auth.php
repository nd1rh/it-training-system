<?php

namespace App\Controllers;

use App\Models\TraineeModel;
use App\Models\TrainerModel;

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
        $rules = [
            'full_name' => 'required|min_length[2]',
            'email'     => 'required|valid_email',
            'password'  => 'required|min_length[8]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
        $role = 'trainee';

        $traineeModel = new TraineeModel();

        if ($traineeModel->where('email', $this->request->getPost('email'))->first()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', ['Email already registered']);
        }

        $data = [
            'full_name'     => $this->request->getPost('full_name'),
            'email'         => $this->request->getPost('email'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'phone_num'     => $this->request->getPost('phone_num'),
            'gender'        => $this->request->getPost('gender'),
            'date_of_birth' => $this->request->getPost('date_of_birth')
        ];

        $traineeModel->insert($data);
        $userId = $traineeModel->getInsertID();

        session()->set([
            'user_id'    => $userId,
            'full_name'  => $data['full_name'],
            'role'       => $role,
            'isLoggedIn' => true
        ]);

        return redirect()->to('trainee/dashboard');
    }

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

        if ($role === 'trainer') {
            return redirect()->to('trainer/dashboard');
        }

        return redirect()->to('trainee/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
