<?php
namespace App\Models;
use CodeIgniter\Model;

class TraineeModel extends Model
{
    protected $table = 'users'; // Use the table name from your dummy data
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['full_name', 'email', 'password', 'role', 'gender', 'profile_image', 'phone_num', 'course_enrolled'];
}