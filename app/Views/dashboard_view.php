<div class="container mt-5 text-center"> 
    <!-- Use session data directly --> 
    <h1 style="color: <?= session()->get('theme_color') ?>">Welcome, <?= session()->get('username') ?>!</h1> 
    <p>You have successfully logged in via CodeIgniter.</p> 
    <a href="/logout" class="btn btn-danger">Log Out</a> 
</div> 