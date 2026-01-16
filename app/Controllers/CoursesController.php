<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\CourseEnrollmentModel;

class CoursesController extends BaseController
{
    protected $courseModel;
    protected $db;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->db = \Config\Database::connect();
    }

    public function dashboard()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('login')->with('error', 'Please login first.');
        }

        // Courses stats
        $builder = $this->db->table('course_enrollments');
        $builder->select("
        COUNT(*) AS courses_enrolled,
        SUM(status IN ('Enrolled','Paid','In Progress')) AS courses_in_progress,
        SUM(status = 'Completed') AS courses_completed
        ");
        $builder->where('trainee_id', $user_id);
        $stats = $builder->get()->getRowArray();

        $data['courses_enrolled'] = (int)$stats['courses_enrolled'];
        $data['courses_in_progress'] = (int)$stats['courses_in_progress'];
        $data['courses_completed'] = (int)$stats['courses_completed'];

        echo view('templates/header');
        echo view('traineedashboard_view', $data);
        echo view('templates/footer');
    }

    public function enrolled()
    {
        $user_id = session()->get('user_id');

        $builder = $this->db->table('course_enrollments ce');
        $builder->select('ce.course_enroll_id, c.course_id, c.course_name, c.course_desc, c.course_image, ce.status, ce.progress');
        $builder->join('courses c', 'c.course_id = ce.course_id');
        $builder->where('ce.trainee_id', $user_id);

        $data['courses'] = $builder->get()->getResultArray();

        echo view('templates/header');
        echo view('courses/enrolled_view', $data);
        echo view('templates/footer');
    }

    public function inProgress()
    {
        $user_id = session()->get('user_id');

        $builder = $this->db->table('course_enrollments ce');
        $builder->select('ce.course_enroll_id, c.course_id, c.course_name, c.course_desc, c.course_image, ce.status, ce.progress');
        $builder->join('courses c', 'c.course_id = ce.course_id');
        $builder->where('ce.trainee_id', $user_id);
        $builder->whereIn('ce.status', ['Enrolled', 'Paid', 'In Progress']);

        $courses = $builder->get()->getResultArray();
        $enrollModel = new CourseEnrollmentModel();

        // Auto move completed courses
        foreach ($courses as $key => $course) {
            if ((int)$course['progress'] >= 100 && $course['status'] !== 'Completed') {
                $enrollModel->update($course['course_enroll_id'], [
                    'status' => 'Completed',
                    'progress' => 100,
                    'completed_date' => date('Y-m-d H:i:s')
                ]);
                $courses[$key]['status'] = 'Completed';
                $courses[$key]['progress'] = 100;
            }
        }

        $data['courses'] = $courses;

        echo view('templates/header');
        echo view('courses/in_progress_view', $data);
        echo view('templates/footer');
    }

    public function completed()
    {
        $user_id = session()->get('user_id');

        $builder = $this->db->table('course_enrollments ce');
        $builder->select('ce.course_enroll_id, c.course_id, c.course_name, c.course_desc, c.course_image, ce.status, ce.progress');
        $builder->join('courses c', 'c.course_id = ce.course_id');
        $builder->where('ce.trainee_id', $user_id);
        $builder->where('ce.status', 'Completed');

        $data['courses'] = $builder->get()->getResultArray();

        echo view('templates/header');
        echo view('courses/completed_view', $data);
        echo view('templates/footer');
    }

    public function detail($course_id)
    {
        $data['course'] = $this->courseModel->find($course_id);

        if (!$data['course']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Course not found');
        }

        $traineeId = session()->get('trainee_id');
        $data['isEnrolled'] = false;

        if ($traineeId) {
            $enrollModel = new CourseEnrollmentModel();
            $data['isEnrolled'] = $enrollModel->isAlreadyEnrolled($traineeId, $course_id);
        }

        echo view('templates/header');
        echo view('courses/detail_view', $data);
        echo view('templates/footer');
    }

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

        if (empty($keyword)) {
            // If no keyword, return all courses
            $courses = $this->courseModel->limit(8)->findAll();
        } else {
            // Search by course name or description
            $courses = $this->courseModel
                ->like('course_name', $keyword)
                ->orLike('course_desc', $keyword)
                ->findAll();
        }

        // Build HTML response matching the home page structure
        $html = '';

        if (!empty($courses)) {
            foreach ($courses as $course) {
                $courseImg = $course['course_image'] ?? 'uploads/courses/default.png';

                $html .= '
                <div class="col-lg-3 col-md-4 col-sm-6 course-item" style="opacity: 0;">
                    <div class="course-card" onclick="location.href=\'' . site_url('courses/detail/' . $course['course_id']) . '\'">
                        <img src="' . base_url($courseImg) . '" alt="' . esc($course['course_name']) . '" class="course-image">
                        <div class="course-content">
                            <h5 class="course-title">' . esc($course['course_name']) . '</h5>
                            <p class="course-desc">' . esc(substr($course['course_desc'], 0, 70)) . '...</p>
                        </div>
                    </div>
                </div>';
            }
        } else {
            $html = '<p class="text-center no-course">No courses found matching your search.</p>';
        }

        return $this->response->setBody($html);
    }

    public function updateProgress($enrollId)
    {
        $traineeId = session()->get('user_id');

        if (!$traineeId) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        $enrollModel = new CourseEnrollmentModel();
        $enrollment = $enrollModel->where('course_enroll_id', $enrollId)
            ->where('trainee_id', $traineeId)
            ->first();

        if (!$enrollment) {
            return redirect()->back()->with('error', 'Enrollment not found.');
        }

        $newProgress = $enrollment['progress'] + 20;
        if ($newProgress >= 100) {
            $newProgress = 100;
            $status = 'Completed';
            $completedDate = date('Y-m-d H:i:s');
        } else {
            $status = 'In Progress';
            $completedDate = null;
        }

        $enrollModel->update($enrollId, [
            'progress' => $newProgress,
            'status' => $status,
            'completed_date' => $completedDate
        ]);

        return redirect()->back()->with('success', 'Progress updated to ' . $newProgress . '%');
    }
}
