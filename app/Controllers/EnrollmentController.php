<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\CourseEnrollmentModel;

class EnrollmentController extends BaseController
{
    public function enroll($courseId)
    {
        if (session()->get('role') !== 'trainee') {
            return redirect()->to('/login')
                ->with('error', 'Please login as trainee.');
        }

        $traineeId = session()->get('user_id');

        $courseModel = new CourseModel();
        $enrollModel = new CourseEnrollmentModel();

        $course = $courseModel->find($courseId);

        if (!$course || !$traineeId) {
            return redirect()->back()
                ->with('error', 'Course not found.');
        }

        // Prevent duplicate enrollment
        $existing = $enrollModel
            ->where('trainee_id', $traineeId)
            ->where('course_id', $courseId)
            ->first();

        if ($existing) {
            return redirect()->to(site_url('enrolled'))
                ->with('info', 'You are already enrolled in this course.');
        }

        // Free course
        if ((float)$course['price'] === 0.00) {
            $enrollModel->insert([
                'trainee_id' => $traineeId,
                'course_id'  => $courseId,
                'status'     => 'Enrolled'
            ]);

            return redirect()->to(site_url('enrolled'))
                ->with('success', 'You have successfully enrolled.');
        }

        // Paid course
        return redirect()->to(site_url('payment/' . $courseId));
    }

    public function enrolledCourses()
    {
        if (session()->get('role') !== 'trainee') {
            return redirect()->to('/login')
                ->with('error', 'Access denied.');
        }

        $traineeId = session()->get('user_id');

        $db = \Config\Database::connect();

        $courses = $db->table('course_enrollments ce')
            ->select('c.course_id, c.course_name, c.course_desc, ce.status')
            ->join('courses c', 'c.course_id = ce.course_id')
            ->where('ce.trainee_id', $traineeId)
            ->get()
            ->getResultArray();

        echo view('templates/header');
        echo view('courses/enrolled_view', ['courses' => $courses]);
        echo view('templates/footer');
    }
}
