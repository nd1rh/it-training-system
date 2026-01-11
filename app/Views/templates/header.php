<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>StartIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding-top: 70px;
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
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="/directory/trainer">Trainers</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    About
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                    <li><a class="dropdown-item" href="/about/company">Company</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="/about/web_policy">Web Policy</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Profile
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if (session()->get('role') === 'trainer'): ?>
                                        <li><a class="dropdown-item" href="<?= base_url('profile') ?>">My Profile</a></li>
                                    <?php else: ?>
                                        <li><a class="dropdown-item" href="<?= base_url('trainee/profile') ?>">My Profile</a></li>
                                    <?php endif; ?>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
                                </ul>
                            </li>

                        <?php elseif (session()->get('role') === 'trainer'): ?>
                            <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="configureDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Configuration
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="configureDropdown">
                                    <li><a class="dropdown-item" href="<?= site_url('configure/trainee') ?>">Trainee</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="<?= site_url('configure/course_fee') ?>">Course Fee</a></li>
                                </ul>
                            </li>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    About
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                    <li><a class="dropdown-item" href="/about/company">Company</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="/about/web_policy">Web Policy</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Profile
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?= base_url('trainerprofile') ?>">My Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
                                </ul>
                            </li>

                        <?php endif; ?>

                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/trainer">Trainer Directory</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                About
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                <li><a class="dropdown-item" href="/about/company">Company</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
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