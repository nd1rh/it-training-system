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
            'first_name' => 'required|min_length[2]',
            'email'      => 'required|valid_email|is_unique[users.email]',
            'password'   => 'required|min_length[8]'
        ];
        // 2. Check Validation 
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 3. Prepare Data 
        $userModel = new UserModel();
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'email'      => $this->request->getPost('email'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'       => 'member'
        ];

        // 4. Save 
        $userModel->save($data);

        // 5. Login User (Session) 
        session()->set([
            'user_id' => $userModel->getInsertID(),
            'username' => $data['first_name'],
            'isLoggedIn' => true
        ]);

        return redirect()->to('/dashboard');
    }

    public function login()
    {
        // Load the header template 
        echo view('templates/header');

        // Load the login form view 
        echo view('login_view');

        // Load the footer template 
        echo view('templates/footer');
    }
    public function loginProcess()
    {
        // Get form input values sent via POST 
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Load the User model to check the database 
        $userModel = new UserModel();

        // Find the user by email 
        $user = $userModel->where('email', $email)->first();

        // If a user with that email exists 
        if ($user) {
            // Verify the password using PHP's built-in password hashing 
            if (password_verify($password, $user['password'])) {

                // Store user data in session after successful login 
                session()->set([
                    'user_id'   => $user['id'],
                    'username'  => $user['first_name'],
                    'isLoggedIn' => true
                ]);
                // Redirect the user to the dashboard page 
                return redirect()->to('/dashboard');
            }
        }
        // If email or password is incorrect, redirect back with an error message 
        return redirect()->back()->with('error', 'Invalid Email or Password');
    }
    public function logout()
    {
        // Destroy all session data (log out the user) 
        session()->destroy();
        // Redirect back to the login page 
        return redirect()->to('/login');
    }
}
