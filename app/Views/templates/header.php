<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>StartIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">

    <style>
        body {
            padding-top: 100px;
        }
    </style>
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">StartIT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (session()->get('isLoggedIn')): ?>
                        <?php if (session()->get('role') === 'trainee'): ?>

                            <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="directoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Directory
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="directoryDropdown">
                                    <li><a class="dropdown-item" href="/directory/course">Courses</a></li>
                                    <li><a class="dropdown-item" href="/directory/tutor">Tutors</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    About
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                    <li><a class="dropdown-item" href="/about/company">Company</a></li>
                                    <li><a class="dropdown-item" href="/about/web_policy">Web Policy</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center"
                                    href="#"
                                    id="profileDropdown"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">

                                    <img src="<?= session()->get('profile_image')
                                                    ? base_url('assets/images/' . session()->get('profile_image'))
                                                    : base_url('assets/images/default-avatar.png') ?>"
                                        class="rounded-circle"
                                        width="25"
                                        height="25"
                                        alt="Profile">
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                    <li><a class="dropdown-item" href="/profile/my_profile">My Profile</a></li>
                                    <li><a class="dropdown-item" href="/logout">Logout</a></li>
                                </ul>
                            </li>
                        <?php elseif (session()->get('role') === 'admin'): ?>
                            <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="configureDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Configuration
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="configureDropdown">
                                    <li><a class="dropdown-item" href="/configure/trainee">Trainee</a></li>
                                    <li><a class="dropdown-item" href="/configure/course_fee">Course Fee</a></li>
                                </ul>
                            </li>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    About
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                    <li><a class="dropdown-item" href="/about/company">Company</a></li>
                                    <li><a class="dropdown-item" href="/about/web_policy">Web Policy</a></li>
                                </ul>
                            </li>

                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>

                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/trainer">Trainer</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                About
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                <li><a class="dropdown-item" href="/about/company">Company</a></li>
                                <li><a class="dropdown-item" href="/about/web_policy">Web Policy</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>