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
        'first_name',  
        'email',  
        'password',  
        'birth_date',  
        'gender',  
        'year_of_study',  
        'theme_color', 
        'role' // Add new column role in the database PhpMyAdmin 
    ]; 
     
    // CodeIgniter can automatically handle timestamps, but our table uses 
    // a TIMESTAMP column that updates itself, so we can disable this for now. 
    protected $useTimestamps = false;  
} 