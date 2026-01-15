<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseEnrollmentModel extends Model
{
    protected $table      = 'course_enrollments';
    protected $primaryKey = 'course_enroll_id';

    protected $allowedFields = [
        'trainee_id',
        'course_id',
        'status',
        'enrolled_date',
        'completed_date',
        'progress'
    ];

    protected $useTimestamps = false;

    // Optional helper
    public function isAlreadyEnrolled($traineeId, $courseId)
    {
        return $this->where([
            'trainee_id' => $traineeId,
            'course_id'  => $courseId
        ])->first();
    }
}
