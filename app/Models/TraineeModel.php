<?php

namespace App\Models;

use CodeIgniter\Model;

class TraineeModel extends Model
{
    protected $table      = 'trainees';
    protected $primaryKey = 'trainee_id';

    protected $allowedFields = [
        'full_name',
        'email',
        'password',
        'gender',
        'phone_num',
        'date_of_birth',
        'profile_pic'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'created_at';

    /**
     * Get all trainees with course info, payment, and status
     */
    public function getTraineesWithDetails($keyword = null)
    {
        $builder = $this->db->table('trainees t');

        $builder->select('
            t.trainee_id,
            t.full_name,
            t.email,
            t.phone_num,
            c.course_name,
            c.course_id,
            c.price,
            ce.course_enroll_id,
            ce.status AS course_status,
            p.payment_status
        ');

        $builder->join('course_enrollments ce', 'ce.trainee_id = t.trainee_id', 'left');
        $builder->join('courses c', 'c.course_id = ce.course_id', 'left');
        $builder->join('payments p', 'p.course_enroll_id = ce.course_enroll_id', 'left');

        if ($keyword) {
            $builder->groupStart()
                ->like('t.full_name', $keyword)
                ->orLike('t.email', $keyword)
                ->orLike('c.course_name', $keyword)
                ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }
}
