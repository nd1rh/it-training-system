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
    // Dashboard: stats + available courses
    // -------------------------
    public function dashboard()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('login');
        }

        // 1️⃣ Courses stats
        $builder = $this->db->table('course_enrollments');
        $builder->select('status, COUNT(*) AS count')
            ->where('trainee_id', $user_id)
            ->groupBy('status');
        $stats = $builder->get()->getResultArray();

        // Default counts
        $data['courses_enrolled'] = 0;
        $data['courses_in_progress'] = 0;
        $data['courses_completed'] = 0;

        foreach ($stats as $row) {
            switch ($row['status']) {
                case 'Enrolled':
                    $data['courses_enrolled'] = $row['count'];
                    break;
                case 'In Progress':
                    $data['courses_in_progress'] = $row['count'];
                    break;
                case 'Completed':
                    $data['courses_completed'] = $row['count'];
                    break;
            }
        }

        // 2️⃣ Available courses (not yet enrolled)
        $builder = $this->db->table('course_enrollments');
        $builder->select('course_id')
            ->where('trainee_id', $user_id);
        $enrolled_courses = $builder->get()->getResultArray();
        $enrolled_ids = array_column($enrolled_courses, 'course_id');

        $builder = $this->db->table('courses');
        $builder->select('*');
        if (!empty($enrolled_ids)) {
            $builder->whereNotIn('course_id', $enrolled_ids);
        }
        $data['available_courses'] = $builder->get()->getResultArray();

        echo view('templates/header');
        echo view('dashboard_view', $data);
        echo view('templates/footer');
    }

    // -------------------------
    // Courses Enrolled (All)
    // -------------------------
    public function enrolled()
    {
        $user_id = session()->get('user_id');

        $builder = $this->db->table('course_enrollments ce');
        $builder->select('c.course_id, c.course_name, c.course_desc, ce.status');
        $builder->join('courses c', 'c.course_id = ce.course_id');
        $builder->where('ce.trainee_id', $user_id);

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
        $user_id = session()->get('user_id');

        $builder = $this->db->table('course_enrollments ce');
        $builder->select('c.course_id, c.course_name, c.course_desc, ce.status');
        $builder->join('courses c', 'c.course_id = ce.course_id');
        $builder->where('ce.trainee_id', $user_id);
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
        $user_id = session()->get('user_id');

        $builder = $this->db->table('course_enrollments ce');
        $builder->select('c.course_id, c.course_name, c.course_desc, ce.status');
        $builder->join('courses c', 'c.course_id = ce.course_id');
        $builder->where('ce.trainee_id', $user_id);
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

    // -------------------------
    // Certificate Page
    // -------------------------
    public function certificate($course_id)
    {
        $user_id = session()->get('user_id');

        $builder = $this->db->table('course_enrollments ce');
        $builder->select('c.course_name, t.full_name, ce.completed_date');
        $builder->join('courses c', 'c.course_id = ce.course_id');
        $builder->join('trainees t', 't.trainee_id = ce.trainee_id');
        $builder->where('ce.trainee_id', $user_id);
        $builder->where('ce.course_id', $course_id);
        $builder->where('ce.status', 'Completed');

        $course = $builder->get()->getRowArray();

        if (!$course) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Certificate not available.');
        }

        return view('courses/certificate_view', $course);
    }

    public function search()
    {
        $keyword = $this->request->getGet('keyword');
        $user_id = session()->get('user_id');

        $builder = $this->db->table('courses c');
        $builder->select('c.*');
        $builder->whereNotIn('c.course_id', function ($subQuery) use ($user_id) {
            $subQuery->select('course_id')
                ->from('course_enrollments')
                ->where('trainee_id', session()->get('user_id'));
        });

        if ($keyword) {
            $builder->like('c.course_name', $keyword);
        }

        $courses = $builder->get()->getResultArray();

        // Return HTML only for AJAX
        if (!empty($courses)) {
            foreach ($courses as $course) {
                echo '<div class="col-md-3 col-sm-6 course-item">';
                echo '<div class="course-box" onclick="location.href=\'' . site_url('courses/detail/' . $course['course_id']) . '\'">';
                echo '<h5>' . esc($course['course_name']) . '</h5>';
                echo '<p>' . esc(substr($course['course_desc'], 0, 50)) . '...</p>';
                echo '</div></div>';
            }
        } else {
            echo '<p class="text-center">No courses found.</p>';
        }
    }
}
