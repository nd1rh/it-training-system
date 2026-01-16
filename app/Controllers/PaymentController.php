<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\CourseEnrollmentModel;
use App\Models\PaymentModel;

class PaymentController extends BaseController
{
    public function index($courseId)
    {
        if (session()->get('role') !== 'trainee') {
            return redirect()->to('/login')
                ->with('error', 'Please login as trainee.');
        }

        $courseModel = new CourseModel();
        $course = $courseModel->find($courseId);

        if (!$course || (float)$course['price'] === 0.00) {
            return redirect()->back()
                ->with('error', 'Invalid payment request.');
        }

        echo view('templates/header');
        echo view('payment_view', ['course' => $course]);
        echo view('templates/footer');
    }

    public function process()
    {
        if (session()->get('role') !== 'trainee') {
            return redirect()->to('/login')
                ->with('error', 'Unauthorized access.');
        }

        $traineeId = session()->get('user_id');
        $courseId  = $this->request->getPost('course_id');
        $method = $this->request->getPost('payment_method');

        $courseModel = new CourseModel();
        $course = $courseModel->find($courseId);

        if (!$course) {
            return redirect()->back()
                ->with('error', 'Course not found.');
        }

        $enrollModel  = new CourseEnrollmentModel();
        $paymentModel = new PaymentModel();

        if ($enrollModel->isAlreadyEnrolled($traineeId, $courseId)) {
            return redirect()->to('/courses/enrolled')
                ->with('error', 'You have already paid for this course.');
        }

        // Create enrollment
        $enrollId = $enrollModel->insert([
            'trainee_id' => $traineeId,
            'course_id'  => $courseId,
            'status'     => 'Enrolled'
        ]);

        // Record payment
        $paymentModel->insert([
            'course_enroll_id' => $enrollId,
            'amount'           => $course['price'],
            'payment_method'   => $method,
            'payment_status'   => 'Success'
        ]);

        return redirect()->to(site_url('enrolled'))
            ->with('success', 'Payment successful. You are now enrolled.');
    }
}
