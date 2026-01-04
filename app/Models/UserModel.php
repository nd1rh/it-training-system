<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // The table name in your database 
    protected $primaryKey = 'id';

    // Which fields are allowed to be inserted/updated by the user 
    // We include all our registration fields here 
    protected $allowedFields = [
        'role',
        'full_name',
        'email',
        'password',
        'phone_num',
        'gender',
        'payment_status',
        'course_enrolled'
    ];

    // CodeIgniter can automatically handle timestamps, but our table uses 
    // a TIMESTAMP column that updates itself, so we can disable this for now. 
    protected $useTimestamps = false;
}
