<!-- Animated Background Elements -->
<div class="bg-animation">
    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>
    <div class="bg-circle bg-circle-3"></div>
    <div class="bg-circle bg-circle-4"></div>
</div>

<div class="enrolled-page-wrapper">
    <div class="container enrolled-page">

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger text-center">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success text-center">
                <i class="fas fa-check-circle me-2"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Page Header -->
        <section class="enrolled-header text-center fade-in-up" style="animation-delay: 0.1s;">
            <h1 class="enrolled-page-title"><i class="fas fa-graduation-cap me-2"></i>Courses Enrolled</h1>
            <p class="enrolled-page-subtitle">Your learning journey starts here</p>
        </section>

        <?php if (!empty($courses)): ?>
            <div class="enrolled-courses-grid">
                <?php foreach ($courses as $index => $c): ?>
                    <div class="enrolled-course-card fade-in-up" style="animation-delay: <?= 0.2 + ($index * 0.1) ?>s;" onclick="location.href='<?= site_url('courses/detail/' . $c['course_id']) ?>'">
                        <!-- Course Image -->
                        <?php if (!empty($c['course_image'])): ?>
                            <div class="enrolled-course-image-container">
                                <img src="<?= base_url($c['course_image']) ?>" alt="<?= esc($c['course_name']) ?>" class="enrolled-course-image">
                                <div class="enrolled-course-overlay"></div>
                            </div>
                        <?php else: ?>
                            <div class="enrolled-course-image-container enrolled-course-placeholder">
                                <div class="enrolled-course-placeholder-icon"><i class="fas fa-book fa-3x"></i></div>
                            </div>
                        <?php endif; ?>

                        <!-- Course Content -->
                        <div class="enrolled-course-content">
                            <h3 class="enrolled-course-title"><?= esc($c['course_name']) ?></h3>
                            <p class="enrolled-course-desc">
                                <?= esc(substr($c['course_desc'], 0, 100)) ?><?= strlen($c['course_desc']) > 100 ? '...' : '' ?>
                            </p>

                            <!-- Progress Bar -->
                            <?php if (isset($c['progress'])): ?>
                                <div class="enrolled-progress-section">
                                    <div class="enrolled-progress-info">
                                        <span class="enrolled-progress-label"><i class="fas fa-tasks me-1"></i>Progress</span>
                                        <span class="enrolled-progress-value"><?= esc($c['progress']) ?>%</span>
                                    </div>
                                    <div class="enrolled-progress-bar">
                                        <div class="enrolled-progress-fill" style="width: <?= esc($c['progress']) ?>%"></div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Status Badge -->
                            <div class="enrolled-course-footer">
                                <span class="enrolled-status-badge enrolled-status-<?= strtolower(str_replace(' ', '-', $c['status'])) ?>">
                                    <?= esc($c['status']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="enrolled-empty-state fade-in-up" style="animation-delay: 0.2s;">
                <div class="enrolled-empty-icon"><i class="fas fa-book-open fa-4x"></i></div>
                <h3 class="enrolled-empty-title">No Enrolled Courses Yet</h3>
                <p class="enrolled-empty-desc">Start your learning journey by enrolling in a course!</p>
                <a href="<?= site_url('/') ?>" class="enrolled-empty-btn"><i class="fas fa-search me-2"></i>Browse Courses</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Add animated background class to body
        $('body').addClass('animated-background');

        // Trigger animations on page load
        $('.fade-in-up').each(function(index) {
            $(this).css('opacity', '1');
        });
    });
</script>