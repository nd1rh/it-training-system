<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function webPolicy()
    {
        echo view('templates/header'); 
        echo view('web_policy'); 
        echo view('templates/footer'); 
    }

    public function about()
    {
        echo view('templates/header'); 
        echo view('about_view'); 
        echo view('templates/footer'); 
    }
}
