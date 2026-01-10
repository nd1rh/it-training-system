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
        'gender',
        'specialization',
        'experience_years'
    ];
    protected $useTimestamps = false;
}
