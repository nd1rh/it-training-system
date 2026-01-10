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

        #searchInput {
            max-width: 400px;
            margin: 0 auto 30px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Welcome to StartIT!</h1>

        <!-- Search -->
        <input type="text" id="searchInput" class="form-control" placeholder="Search courses...">

        <!-- Available Courses -->
        <div class="row g-3" id="courseContainer">
            <?php if (!empty($available_courses)): ?>
                <?php foreach ($available_courses as $course): ?>
                    <div class="col-md-3 col-sm-6 course-item">
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var query = $(this).val();

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