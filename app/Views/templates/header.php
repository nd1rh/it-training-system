<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>StartIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url('/') ?>">
                <img src="<?= base_url('assets/images/logo.jpg') ?>" alt="StartIT" class="me-2" style="height: 35px; width: auto;">
                <span>StartIT</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (session()->get('isLoggedIn')): ?>
                        <?php if (session()->get('role') === 'trainee'): ?>
                            <li class="nav-item"><a class="nav-link" href="/trainee/dashboard"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="directoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-folder-open me-1"></i>Directory
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="directoryDropdown">
                                    <li><a class="dropdown-item" href="/directory/course"><i class="fas fa-book me-2"></i>Courses</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="/directory/trainer"><i class="fas fa-chalkboard-teacher me-2"></i>Trainers</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-info-circle me-1"></i>About
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="aboutDropdown">
                                    <li><a class="dropdown-item" href="/about/company"><i class="fas fa-building me-2"></i>Company</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="/about/web_policy"><i class="fas fa-file-contract me-2"></i>Web Policy</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle me-1"></i>Profile
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="profileDropdown">
                                    <li><a class="dropdown-item" href="<?= base_url('trainee/profile') ?>"><i class="fas fa-user me-2"></i>My Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                                </ul>
                            </li>

                        <?php elseif (session()->get('role') === 'trainer'): ?>
                            <li class="nav-item"><a class="nav-link" href="/trainer/dashboard"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="configureDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-cog me-1"></i>Configuration
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="configureDropdown">
                                    <li><a class="dropdown-item" href="<?= site_url('configure/trainee') ?>"><i class="fas fa-users me-2"></i>Trainee</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?= site_url('configure/course') ?>"><i class="fas fa-book me-2"></i>Course</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-info-circle me-1"></i>About
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="aboutDropdown">
                                    <li><a class="dropdown-item" href="/about/company"><i class="fas fa-building me-2"></i>Company</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="/about/web_policy"><i class="fas fa-file-contract me-2"></i>Web Policy</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle me-1"></i>Profile
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="profileDropdown">
                                    <li><a class="dropdown-item" href="<?= base_url('trainerprofile') ?>"><i class="fas fa-user me-2"></i>My Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>

                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/"><i class="fas fa-home me-1"></i>Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/trainer"><i class="fas fa-chalkboard-teacher me-1"></i>Trainer Directory</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-info-circle me-1"></i>About
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="aboutDropdown">
                                <li><a class="dropdown-item" href="/about/company"><i class="fas fa-building me-2"></i>Company</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/about/web_policy"><i class="fas fa-file-contract me-2"></i>Web Policy</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/register"><i class="fas fa-user-plus me-1"></i>Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="/login"><i class="fas fa-sign-in-alt me-1"></i>Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>