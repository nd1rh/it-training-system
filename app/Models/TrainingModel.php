<?php

namespace App\Models;

use CodeIgniter\Model;

class TrainingModel extends Model
{
    protected $table = 'trainings';
    protected $primaryKey = 'training_id';
    protected $allowedFields = [
        'course_id',
        'trainer_id'
    ];
}
