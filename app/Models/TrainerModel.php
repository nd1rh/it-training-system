<?php

namespace App\Models;

use CodeIgniter\Model;

class TrainerModel extends Model
{
    protected $table = 'trainers';
    protected $primaryKey = 'trainer_id';
    protected $allowedFields = [
        'full_name',
        'email',
        'password',
        'phone_number',
        'gender',
        'specialization',
        'experience_years',
        'profile_pic'
    ];
    protected $useTimestamps = false;

    public function getTrainerProfile($id)
    {
        return $this->where('trainer_id', $id)->first();
    }
}
