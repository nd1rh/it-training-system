<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CI4 Student Hub</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <style>
        body {
            padding-top: 70px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">Student Hub (CI4)</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <?php if (session()->get('isLoggedIn')): ?>
                        <li class="nav-item"><a class="nav-link"
                                href="/dashboard">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link"
                                href="/logout">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link"
                                href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link"
                                href="/about">About</a></li>
                        <li class="nav-item"><a class="nav-link"
                                href="/register">Register</a></li>
                        <li class="nav-item"><a class="nav-link"
                                href="/login">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>