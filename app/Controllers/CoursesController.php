<?php

namespace App\Controllers;

use App\Models\CourseModel;
use CodeIgniter\Controller;

class CoursesController extends BaseController
{
    protected $courseModel;
    protected $db;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->db = \Config\Database::connect();
    }

    // -------------------------
    // Courses Enrolled (All)
    // -------------------------
    public function enrolled()
    {
        $builder = $this->db->table('course_enrollments ce');
        $builder->select('c.course_id, c.course_name, c.course_desc, ce.status');
        $builder->join('courses c', 'c.course_id = ce.course_id');
        $builder->where('ce.trainee_id', session()->get('user_id'));

        $data['courses'] = $builder->get()->getResultArray();

        echo view('templates/header');
        echo view('courses/enrolled_view', $data);
        echo view('templates/footer');
    }

    // -------------------------
    // Courses In Progress
    // -------------------------
    public function inProgress()
    {
        $builder = $this->db->table('course_enrollments ce');
        $builder->select('c.course_id, c.course_name, c.course_desc, ce.status');
        $builder->join('courses c', 'c.course_id = ce.course_id');
        $builder->where('ce.trainee_id', session()->get('user_id'));
        $builder->where('ce.status', 'In Progress');

        $data['courses'] = $builder->get()->getResultArray();

        echo view('templates/header');
        echo view('courses/in_progress_view', $data);
        echo view('templates/footer');
    }

    // -------------------------
    // Courses Completed
    // -------------------------
    public function completed()
    {
        $builder = $this->db->table('course_enrollments ce');
        $builder->select('c.course_id, c.course_name, c.course_desc, ce.status');
        $builder->join('courses c', 'c.course_id = ce.course_id');
        $builder->where('ce.trainee_id', session()->get('user_id'));
        $builder->where('ce.status', 'Completed');

        $data['courses'] = $builder->get()->getResultArray();

        echo view('templates/header');
        echo view('courses/completed_view', $data);
        echo view('templates/footer');
    }

    // -------------------------
    // Course Detail Page
    // -------------------------
    public function detail($course_id)
    {
        $data['course'] = $this->courseModel->find($course_id);

        if (!$data['course']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Course not found');
        }

        echo view('templates/header');
        echo view('courses/detail_view', $data);
        echo view('templates/footer');
    }
    public function certificate($course_id)
    {
        // Use Query Builder to fetch trainee + course + completion date
        $builder = $this->db->table('course_enrollments ce');
        $builder->select('c.course_name, t.full_name, ce.completed_date');
        $builder->join('courses c', 'c.course_id = ce.course_id');
        $builder->join('trainees t', 't.trainee_id = ce.trainee_id');
        $builder->where('ce.trainee_id', session()->get('user_id'));
        $builder->where('ce.course_id', $course_id);
        $builder->where('ce.status', 'Completed');

        $course = $builder->get()->getRowArray();

        if (!$course) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Certificate not available.');
        }

        // Pass data to a simple certificate view
        return view('courses/certificate_view', $course);
    }
}
