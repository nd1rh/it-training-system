<?php

namespace App\Controllers;

use App\Models\CourseModel;

class ManageCourseController extends BaseController
{
    protected $courseModel;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        helper('form');
    }

    // ------------------------------
    // Display course list
    // ------------------------------
    public function index()
    {
        $data['courses'] = $this->courseModel->findAll();
        echo view('templates/header');
        echo view('managecourse_view', $data);
        echo view('templates/footer');
    }

    // ------------------------------
    // AJAX search
    // ------------------------------
    public function search()
    {
        $keyword = $this->request->getGet('keyword');
        $courses = $this->courseModel
            ->like('course_name', $keyword)
            ->orLike('course_desc', $keyword)
            ->findAll();

        return $this->response->setJSON($courses);
    }

    // ------------------------------
    // Show Add Course form
    // ------------------------------
    public function add()
    {
        echo view('templates/header');
        echo view('course_add_view');
        echo view('templates/footer');
    }

    // -----------------
    // Save new course 
    // -----------------
    public function save()
    {
        $rules = [
            'course_name'     => 'required|min_length[3]|max_length[255]',
            'course_desc'     => 'required|min_length[10]',
            'course_duration' => 'required|integer|greater_than[0]',
            'price'           => 'required|numeric|greater_than_equal_to[0]',
            'course_image'    => 'permit_empty|is_image[course_image]|max_size[course_image,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'course_name'     => $this->request->getPost('course_name'),
            'course_desc'     => $this->request->getPost('course_desc'),
            'course_duration' => $this->request->getPost('course_duration'),
            'price'           => $this->request->getPost('price'),
        ];

        // Optional: handle image upload
        $file = $this->request->getFile('course_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/courses/', $newName);
            $data['course_image'] = 'uploads/courses/' . $newName;
        }

        $this->courseModel->save($data);

        return redirect()->to('/configure/course')->with('success', 'Course added successfully!');
    }

    // ------------------------------
    // Edit course
    // ------------------------------
    public function edit($courseId)
    {
        $course = $this->courseModel->find($courseId);
        if (!$course) {
            return redirect()->to('/configure/course')->with('error', 'Course not found.');
        }
        $data['course'] = $course;

        echo view('templates/header');
        echo view('edit_course_view', $data);
        echo view('templates/footer');
    }

    // ------------------------------
    // Update course
    // ------------------------------
    public function update($courseId)
    {
        $course = $this->courseModel->find($courseId);
        if (!$course) {
            return redirect()->to('/configure/course')->with('error', 'Course not found.');
        }

        $rules = [
            'course_name'     => 'required|min_length[3]|max_length[255]',
            'course_desc'     => 'required|min_length[10]',
            'course_duration' => 'required|integer|greater_than[0]',
            'price'           => 'required|numeric|greater_than_equal_to[0]',
            'course_image'    => 'permit_empty|is_image[course_image]|max_size[course_image,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'course_name'     => $this->request->getPost('course_name'),
            'course_desc'     => $this->request->getPost('course_desc'),
            'course_duration' => $this->request->getPost('course_duration'),
            'price'           => $this->request->getPost('price'),
        ];

        // Optional: handle new image
        $file = $this->request->getFile('course_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/courses/', $newName);
            $data['course_image'] = 'uploads/courses/' . $newName;
        }

        $this->courseModel->update($courseId, $data);

        return redirect()->to('/configure/course')->with('success', 'Course updated successfully!');
    }

    // ------------------------------
    // Delete course
    // ------------------------------
    public function delete($courseId)
    {
        $course = $this->courseModel->find($courseId);
        if (!$course) {
            return redirect()->to('/configure/course')->with('error', 'Course not found.');
        }

        $this->courseModel->delete($courseId);
        return redirect()->to('/configure/course')->with('success', 'Course deleted successfully!');
    }
}
