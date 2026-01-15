<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>StartIT Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/trainee_dashboard.css') ?>" rel="stylesheet">
</head>

<body>

    <!-- Animated Background Elements -->
    <div class="bg-animation">
        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>
        <div class="bg-circle bg-circle-4"></div>
    </div>

    <div class="dashboard-container container" style="position: relative; z-index: 1; padding-top: 100px;"> <div class="dashboard-welcome text-center mt-5">
            <h1 class="display-5 fw-bold text-primary">Welcome, <?= esc(session()->get('full_name')) ?>!</h1>
            <p class="lead text-muted">Track your learning progress and upcoming tasks here.</p>
        </div>

        <div class="stat-grid">
            <div class="stat-card enrolled" onclick="location.href='<?= site_url('courses/enrolled') ?>'">
                <span class="stat-number"><?= $courses_enrolled ?? 0 ?></span>
                <span class="stat-label">Courses Enrolled</span>
            </div>

            <div class="stat-card progress" onclick="location.href='<?= site_url('courses/in-progress') ?>'">
                <span class="stat-number"><?= $courses_in_progress ?? 0 ?></span>
                <span class="stat-label">In Progress</span>
            </div>

            <div class="stat-card completed" onclick="location.href='<?= site_url('courses/completed') ?>'">
                <span class="stat-number"><?= $courses_completed ?? 0 ?></span>
                <span class="stat-label">Courses Completed</span>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('body').addClass('animated-background');
        });
    </script>
</body>
</html>