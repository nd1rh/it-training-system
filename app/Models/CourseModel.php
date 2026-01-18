<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table      = 'courses';
    protected $primaryKey = 'course_id';

    protected $allowedFields = [
        'course_name',
        'course_desc',
        'course_duration',
        'price',
        'course_image'
    ];

    protected $useTimestamps = false;

    public function getCoursesWithFees($keyword = null)
    {
        $builder = $this->db->table('courses');

        $builder->select('
            course_id,
            course_name,
            course_desc,
            course_duration,
            price,
            course_image
        ');

        if ($keyword) {
            $builder->groupStart()
                ->like('course_name', $keyword)
                ->orLike('course_desc', $keyword)
                ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }

    public function getCourseWithTrainer($course_id)
    {
        return $this->select('courses.*, trainers.full_name AS trainer_name')
            ->join('trainings', 'trainings.course_id = courses.course_id')
            ->join('trainers', 'trainers.trainer_id = trainings.trainer_id')
            ->where('courses.course_id', $course_id)
            ->first();
    }
}
