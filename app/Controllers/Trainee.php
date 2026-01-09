<?php
namespace App\Controllers;

class Trainee extends BaseController
{
    public function index()
    {
        // This loads your trainees_view.php file
        return view('trainees_view');
    }
}