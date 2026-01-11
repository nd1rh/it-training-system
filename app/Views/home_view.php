<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>StartIT Home</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <!-- Page Title -->
        <h1 class="text-center page-title">Welcome to StartIT</h1>
        <p class="text-center page-subtitle">
            Explore professional IT courses and boost your skills
        </p>

        <!-- Search -->
        <input type="text" id="searchInput" class="form-control" placeholder="Search courses...">

        <!-- Course List -->
        <div class="row g-4" id="courseContainer">
            <?php if (!empty($available_courses)): ?>
                <?php foreach ($available_courses as $course): ?>

                    <?php
                    $courseImg = $course['course_image'] ?? 'uploads/courses/default.png';
                    ?>

                    <div class="col-md-3 col-sm-6 course-item">
                        <div class="course-box"
                            onclick="location.href='<?= site_url('courses/detail/' . $course['course_id']) ?>'">

                            <!-- Course Image -->
                            <img
                                src="<?= base_url($courseImg) ?>"
                                alt="<?= esc($course['course_name']) ?>"
                                class="course-image">

                            <h5><?= esc($course['course_name']) ?></h5>
                            <p><?= esc(substr($course['course_desc'], 0, 60)) ?>...</p>

                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center no-course">No courses available.</p>
            <?php endif; ?>
        </div>

    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- AJAX Search -->
    <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                let query = $(this).val();

                $.ajax({
                    url: '<?= site_url("courses/search") ?>',
                    method: 'GET',
                    data: {
                        keyword: query
                    },
                    success: function(response) {
                        $('#courseContainer').html(response);
                    }
                });
            });
        });
    </script>

</body>

</html>