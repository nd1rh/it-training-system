<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StartIT | Home</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Main CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body class="animated-background">

    <!-- Animated Background Elements -->
    <div class="bg-animation">
        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>
        <div class="bg-circle bg-circle-4"></div>
    </div>

    <!-- =========================
         HOME PAGE
    ========================== -->
    <div class="container home-page">

        <!-- =========================
             PAGE HEADER
        ========================== -->
        <section class="home-header text-center">
            <h1 class="page-title">Welcome to StartIT</h1>
            <p class="page-subtitle">
                Explore professional IT courses and boost your skills
            </p>
        </section>

        <!-- =========================
             SEARCH BAR
        ========================== -->
        <section class="home-search mb-5">
            <div class="position-relative">
                <i class="fas fa-search position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 10;"></i>
                <input
                    type="text"
                    id="searchInput"
                    class="form-control search-input"
                    placeholder="Search courses by name or keyword..."
                    style="padding-left: 45px;">
            </div>
        </section>

        <!-- =========================
             COURSE LIST
        ========================== -->
        <section class="home-courses">
            <div class="row g-4" id="courseContainer">

                <?php if (!empty($available_courses)): ?>
                    <?php foreach ($available_courses as $course): ?>

                        <?php
                        $courseImg = $course['course_image'] ?? 'uploads/courses/default.png';
                        ?>

                        <div class="col-lg-3 col-md-4 col-sm-6 course-item">
                            <div
                                class="course-card"
                                onclick="location.href='<?= site_url('courses/detail/' . $course['course_id']) ?>'">

                                <!-- Course Image -->
                                <img
                                    src="<?= base_url($courseImg) ?>"
                                    alt="<?= esc($course['course_name']) ?>"
                                    class="course-image">

                                <!-- Course Content -->
                                <div class="course-content">
                                    <h5 class="course-title"><i class="fas fa-book me-2"></i><?= esc($course['course_name']) ?></h5>
                                    <p class="course-desc">
                                        <?= esc(substr($course['course_desc'], 0, 70)) ?>...
                                    </p>
                                </div>

                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center no-course">No courses available at the moment.</p>
                <?php endif; ?>

            </div>
        </section>

    </div>

    <!-- =========================
         SCRIPTS
    ========================== -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- AJAX Course Search -->
    <script>
        // Function to animate course cards
        function animateCourseCards() {
            $('.course-item').each(function(index) {
                $(this).css({
                    'opacity': '0',
                    'animation-delay': (index * 0.1) + 's'
                });
                
                // Force reflow to restart animation
                void this.offsetWidth;
                
                $(this).css('opacity', '1');
            });
        }
        
        $(document).ready(function() {
            // Animate initial course cards on page load
            animateCourseCards();
            
            let searchTimeout;
            
            $('#searchInput').on('keyup', function() {
                let query = $(this).val().trim();
                
                // Clear previous timeout
                clearTimeout(searchTimeout);
                
                // Wait 300ms after user stops typing before searching
                searchTimeout = setTimeout(function() {
                    $.ajax({
                        url: '<?= site_url("courses/search") ?>',
                        method: 'GET',
                        data: {
                            keyword: query
                        },
                        success: function(response) {
                            $('#courseContainer').html(response);
                            // Trigger fade-in animation for new search results
                            setTimeout(function() {
                                animateCourseCards();
                            }, 50);
                        },
                        error: function(xhr, status, error) {
                            console.error('Search error:', error);
                            $('#courseContainer').html('<p class="text-center text-danger">Error loading search results. Please try again.</p>');
                        }
                    });
                }, 300);
            });
        });
    </script>

</body>

</html>