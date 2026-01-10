<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>StartIT Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            padding-top: 70px;
            padding-bottom: 100px;
            overflow-x: hidden;
            background-color: #f8f9fa;
        }

        .stat-box {
            padding: 30px;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .stat-box:hover {
            transform: translateY(-5px);
        }

        .enrolled {
            background-color: #0d6efd;
        }

        .in-progress {
            background-color: #ffc107;
            color: #000;
        }

        .completed {
            background-color: #198754;
        }

        .course-box {
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .course-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center mb-5">Welcome to StartIT!</h1>

        <!-- Top Stats -->
        <div class="row mb-5">
            <div class="col-md-4 mb-3">
                <div class="stat-box enrolled" onclick="location.href='<?= site_url('courses/enrolled') ?>'">
                    <h4>Courses Enrolled</h4>
                    <h2><?= $courses_enrolled ?? 0 ?></h2>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="stat-box in-progress" onclick="location.href='<?= site_url('courses/in-progress') ?>'">
                    <h4>Courses In Progress</h4>
                    <h2><?= $courses_in_progress ?? 0 ?></h2>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="stat-box completed" onclick="location.href='<?= site_url('courses/completed') ?>'">
                    <h4>Courses Completed</h4>
                    <h2><?= $courses_completed ?? 0 ?></h2>
                </div>
            </div>
        </div>

        <!-- Available Courses -->
        <h3 class="mb-4">Available Courses</h3>
        <div class="row g-3">
            <?php if (!empty($available_courses)): ?>
                <?php foreach ($available_courses as $course): ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="course-box" onclick="location.href='<?= site_url('courses/detail/' . $course['course_id']) ?>'">
                            <h5><?= esc($course['course_name']) ?></h5>
                            <p><?= esc(substr($course['course_desc'], 0, 50)) ?>...</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No courses available.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>