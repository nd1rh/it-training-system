<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseFeeModel extends Model
{
    protected $table      = 'courses';
    protected $primaryKey = 'course_id';

    // Matches the columns shown in your database screenshot
    protected $allowedFields = [
        'course_name',
        'course_desc',
        'course_duration',
        'price'
    ];

    // Enable timestamps if your table has created_at/updated_at columns
    protected $useTimestamps = false; 

    /**
     * Get course details with an optional search keyword
     * This follows the logic used in your TraineeModel
     */
    public function getCoursesWithFees($keyword = null)
    {
        $builder = $this->db->table('courses c');

        $builder->select('
            c.course_id,
            c.course_name,
            c.course_desc,
            c.course_duration,
            c.price
        ');

        // Apply search filter if a keyword is provided
        if ($keyword) {
            $builder->groupStart()
                ->like('c.course_name', $keyword)
                ->orLike('c.course_desc', $keyword)
            ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }
}