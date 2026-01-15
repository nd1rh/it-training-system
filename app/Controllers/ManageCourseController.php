<?php

namespace App\Controllers;

use App\Models\CourseModel;

class ManageCourseController extends BaseController
{
    /**
     * Display the list of all courses and their fees
     */
    public function index()
    {
        // Make sure you are using CourseFeeModel
        $model = new CourseModel();

        // Change this from $model->findAll() to:
        $data['courses'] = $model->getCoursesWithFees();

        echo view('templates/header');
        echo view('managecourse_view', $data);
        echo view('templates/footer');
    }

    /**
     * Search for specific courses via AJAX or API
     * Returns results in JSON format
     */
    public function search()
    {
        $keyword = $this->request->getGet('keyword');
        $model = new CourseModel();

        // Searching by course name or description
        $courses = $model->like('course_name', $keyword)
            ->orLike('course_desc', $keyword)
            ->findAll();

        return $this->response->setJSON($courses);
    }

    /**
     * Display edit form for a course
     */
    public function edit($courseId)
    {
        $model = new CourseModel();
        $course = $model->find($courseId);

        if (!$course) {
            return redirect()->to('configure/course')->with('error', 'Course not found.');
        }

        $data['course'] = $course;

        echo view('templates/header');
        echo view('edit_course_view', $data);
        echo view('templates/footer');
    }

    /**
     * Update course data
     */
    public function update($courseId)
    {
        $model = new CourseModel();
        $course = $model->find($courseId);

        if (!$course) {
            return redirect()->to('configure/course')->with('error', 'Course not found.');
        }

        $rules = [
            'course_name'     => 'required|min_length[3]',
            'course_desc'     => 'required',
            'course_duration' => 'required|integer|greater_than[0]',
            'price'           => 'required|decimal'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'course_name'     => $this->request->getPost('course_name'),
            'course_desc'     => $this->request->getPost('course_desc'),
            'course_duration' => $this->request->getPost('course_duration'),
            'price'           => $this->request->getPost('price')
        ];

        // Handle image upload if provided
        $file = $this->request->getFile('course_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/courses/', $newName);
            $data['course_image'] = 'uploads/courses/' . $newName;
        }

        if ($model->update($courseId, $data)) {
            return redirect()->to('configure/course')->with('success', 'Course updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update course.');
        }
    }

    /**
     * Delete a course
     */
    public function delete($courseId)
    {
        $model = new CourseModel();
        $course = $model->find($courseId);

        if (!$course) {
            return redirect()->to('configure/course')->with('error', 'Course not found.');
        }

        if ($model->delete($courseId)) {
            return redirect()->to('configure/course')->with('success', 'Course deleted successfully!');
        } else {
            return redirect()->to('configure/course')->with('error', 'Failed to delete course.');
        }
    }
}
