<?php

namespace App\Controllers;

use App\Models\PaymentModel;

class TrainerDashboardController extends BaseController
{
    public function index()
    {
        $trainerId = session()->get('user_id');

        if (!$trainerId) {
            return redirect()->to('/login');
        }

        $paymentModel = new PaymentModel();
        $revenueData = $paymentModel
            ->select('courses.course_name, SUM(payments.amount) AS total_revenue')
            ->join('course_enrollments', 'course_enrollments.course_enroll_id = payments.course_enroll_id')
            ->join('courses', 'courses.course_id = course_enrollments.course_id')
            ->join('trainings', 'trainings.course_id = courses.course_id')
            ->where('trainings.trainer_id', $trainerId)
            ->where('payments.payment_status', 'success')
            ->groupBy('courses.course_id')
            ->orderBy('total_revenue', 'DESC')
            ->findAll();

        $courseNames   = array_column($revenueData, 'course_name');
        $courseRevenue = array_map('floatval', array_column($revenueData, 'total_revenue'));

        $data = [
            'courseNames'   => $courseNames,
            'courseRevenue' => $courseRevenue,
            'totalEarnings' => array_sum($courseRevenue)
        ];

        echo view('templates/header');
        echo view('trainerdashboard_view', $data);
        echo view('templates/footer');
    }
}
