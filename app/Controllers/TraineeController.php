<?php

namespace App\Controllers;

use App\Models\TraineeModel;

class TraineeController extends BaseController
{
    protected $traineeModel;

    public function __construct()
    {
        $this->traineeModel = new TraineeModel();
    }

    public function index()
    {
        $data['trainees'] = $this->traineeModel->getTraineesWithDetails();

        echo view('templates/header');
        echo view('trainee_view', $data);
        echo view('templates/footer');
    }

    public function search()
    {
        $keyword = $this->request->getGet('keyword');
        $data = $this->traineeModel->getTraineesWithDetails($keyword);

        return $this->response->setJSON($data);
    }

    public function edit($traineeId)
    {
        $trainee = $this->traineeModel->find($traineeId);

        if (!$trainee) {
            return redirect()->to('configure/trainee')->with('error', 'Trainee not found.');
        }

        $data['trainee'] = $trainee;

        echo view('templates/header');
        echo view('edit_trainee_view', $data);
        echo view('templates/footer');
    }

    public function update($traineeId)
    {
        $trainee = $this->traineeModel->find($traineeId);
        if (!$trainee) return redirect()->back()->with('error', 'Trainee not found.');

        $rules = [
            'full_name' => 'required|min_length[2]',
            'email'     => 'required|valid_email',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'full_name'     => $this->request->getPost('full_name'),
            'email'         => $this->request->getPost('email'),
            'phone_num'     => $this->request->getPost('phone_num'),
            'gender'        => $this->request->getPost('gender'),
            'date_of_birth' => $this->request->getPost('date_of_birth')
        ];

        $newPassword = $this->request->getPost('password');
        if (!empty($newPassword)) {
            if (strlen($newPassword) < 8) {
                return redirect()->back()->with('error', 'Password must be at least 8 characters long.');
            }
            $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        if ($this->traineeModel->update($traineeId, $data)) {
            return redirect()->to('configure/trainee')->with('success', 'Trainee updated successfully!');
        }

        return redirect()->back()->with('error', 'Failed to update trainee.');
    }

    public function delete($traineeId)
    {
        $trainee = $this->traineeModel->find($traineeId);
        if (!$trainee) return redirect()->to('configure/trainee')->with('error', 'Trainee not found.');

        $enrollModel = new \App\Models\CourseEnrollmentModel();
        $enrollModel->where('trainee_id', $traineeId)->delete();

        if ($this->traineeModel->delete($traineeId)) {
            return redirect()->to('configure/trainee')->with('success', 'Trainee deleted successfully!');
        }

        return redirect()->to('configure/trainee')->with('error', 'Failed to delete trainee.');
    }
}
