<?php

namespace App\Controllers;

use App\Models\TraineeModel;

class TraineeController extends BaseController
{
    public function index()
{
    $model = new \App\Models\TraineeModel();
    // Don't use $model->findAll(); use your custom function:
    $data['trainees'] = $model->getTraineesWithDetails(); // get all trainees with course/payment info

        echo view('templates/header');
        echo view('trainee_view', $data);
        echo view('templates/footer');
    }

    public function search()
    {
        $model = new \App\Models\TraineeModel();
        $keyword = $this->request->getGet('keyword');

        // Use the custom function that has the JOINs
        $data = $model->getTraineesWithDetails($keyword);

        return $this->response->setJSON($data);
    }

    public function edit($traineeId)
    {
        $model = new \App\Models\TraineeModel();
        $trainee = $model->find($traineeId);

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
        $model = new \App\Models\TraineeModel();
        $trainee = $model->find($traineeId);

        if (!$trainee) {
            return redirect()->to('configure/trainee')->with('error', 'Trainee not found.');
        }

        $rules = [
            'full_name' => 'required|min_length[2]',
            'email'     => 'required|valid_email',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'full_name'     => $this->request->getPost('full_name'),
            'email'         => $this->request->getPost('email'),
            'phone_num'     => $this->request->getPost('phone_num'),
            'gender'        => $this->request->getPost('gender'),
            'date_of_birth' => $this->request->getPost('date_of_birth')
        ];

        // Handle password update if provided
        $newPassword = $this->request->getPost('password');
        if (!empty($newPassword)) {
            if (strlen($newPassword) < 8) {
                return redirect()->back()->with('error', 'Password must be at least 8 characters long.');
            }
            $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        if ($model->update($traineeId, $data)) {
            return redirect()->to('configure/trainee')->with('success', 'Trainee updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update trainee.');
        }
    }

    public function delete($traineeId)
    {
        $model = new \App\Models\TraineeModel();
        $trainee = $model->find($traineeId);

        if (!$trainee) {
            return redirect()->to('configure/trainee')->with('error', 'Trainee not found.');
        }

        // Also delete related enrollments
        $enrollModel = new \App\Models\CourseEnrollmentModel();
        $enrollModel->where('trainee_id', $traineeId)->delete();

        if ($model->delete($traineeId)) {
            return redirect()->to('configure/trainee')->with('success', 'Trainee deleted successfully!');
        } else {
            return redirect()->to('configure/trainee')->with('error', 'Failed to delete trainee.');
        }
    }
}
