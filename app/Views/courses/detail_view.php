<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($course['course_name'] ?? 'Course Detail') ?> | StartIT</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="animated-background">

    <div class="bg-animation">
        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>
        <div class="bg-circle bg-circle-4"></div>
    </div>

    <div class="container course-detail-page">

        <?php if ($course): ?>
            <div class="course-detail-card fade-in-up">
                <div class="course-detail-wrapper">

                    <?php if (!empty($course['course_image'])): ?>
                        <div class="course-image-container fade-in-up" style="animation-delay: 0.2s;">
                            <img src="<?= base_url($course['course_image']) ?>"
                                alt="<?= esc($course['course_name']) ?>"
                                class="course-detail-image">
                        </div>
                    <?php endif; ?>

                    <div class="course-detail-content">

                        <h1 class="course-detail-title fade-in-up" style="animation-delay: 0.3s;">
                            <?= esc($course['course_name']) ?>
                        </h1>

                        <p class="course-detail-description fade-in-up" style="animation-delay: 0.4s;">
                            <?= esc($course['course_desc']) ?>
                        </p>

                        <div class="course-detail-info fade-in-up" style="animation-delay: 0.5s;">
                            <div class="info-item">
                                <span class="info-label">
                                    <i class="fas fa-clock me-2"></i>Duration:
                                </span>
                                <span class="info-value">
                                    <?= esc($course['course_duration']) ?> hours
                                </span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">
                                    <i class="fas fa-tag me-2"></i>Price:
                                </span>
                                <span class="info-value">
                                    <?php if (floatval($course['price']) <= 0): ?>
                                        <span class="badge badge-free">
                                            <i class="fas fa-gift me-1"></i>Free
                                        </span>
                                    <?php else: ?>
                                        <i class="fas fa-money-bill-wave me-1"></i>
                                        RM <?= number_format($course['price'], 2) ?>
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">
                                    <i class="fas fa-user me-2"></i>Trainer:
                                </span>
                                <span class="info-value">
                                    <?= esc($course['trainer_name']) ?>
                                </span>
                            </div>

                        </div>

                        <div class="course-detail-actions fade-in-up" style="animation-delay: 0.6s;">

                            <?php if ($isEnrolled): ?>

                                <div class="alert alert-success mb-3">
                                    <i class="fas fa-check-circle me-2"></i>
                                    You are already enrolled in this course.
                                </div>

                                <a href="<?= site_url('my-courses') ?>" class="btn btn-success">
                                    <i class="fas fa-play me-2"></i>Go to My Courses
                                </a>

                            <?php else: ?>

                                <?php if (floatval($course['price']) > 0): ?>

                                    <a href="<?= site_url('payment/' . $course['course_id']) ?>"
                                        class="btn-enroll">
                                        <i class="fas fa-credit-card me-2"></i>Pay & Enroll
                                    </a>

                                <?php else: ?>

                                    <a href="<?= site_url('enroll/' . $course['course_id']) ?>"
                                        class="btn-enroll"
                                        id="enrollBtn"
                                        data-price="<?= $course['price'] ?>">
                                        <i class="fas fa-user-plus me-2"></i>Enroll Now
                                    </a>

                                <?php endif; ?>

                            <?php endif; ?>

                        </div>


                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class="course-detail-card fade-in-up">
                <p class="text-center">Course not found.</p>
            </div>
        <?php endif; ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.fade-in-up').css('opacity', '1');

            $('#enrollBtn').on('click', function(e) {

                const price = parseFloat($(this).data('price'));

                if (price <= 0) {
                    const confirmEnroll = confirm(
                        "This is a FREE course.\n\n" +
                        "Do you want to enroll now?"
                    );

                    if (!confirmEnroll) {
                        e.preventDefault();
                    }
                }
            });

        });
    </script>

</body>

</html>