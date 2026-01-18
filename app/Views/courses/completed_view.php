<div class="bg-animation">
    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>
    <div class="bg-circle bg-circle-3"></div>
    <div class="bg-circle bg-circle-4"></div>
</div>

<div class="enrolled-page-wrapper">
    <div class="container enrolled-page">
        <section class="enrolled-header text-center fade-in-up" style="animation-delay: 0.1s;">
            <h1 class="enrolled-page-title"><i class="fas fa-trophy me-2"></i>Courses Completed</h1>
            <p class="enrolled-page-subtitle">Congratulations on your achievements!</p>
        </section>

        <?php if (!empty($courses)): ?>
            <div class="enrolled-courses-grid">
                <?php foreach ($courses as $index => $c): ?>
                    <div class="enrolled-course-card fade-in-up" style="animation-delay: <?= 0.2 + ($index * 0.1) ?>s;" 
                    onclick="location.href='<?= site_url('courses/detail/' . $c['course_id']) ?>'">
                        <?php if (!empty($c['course_image'])): ?>
                            <div class="enrolled-course-image-container">
                                <img src="<?= base_url($c['course_image']) ?>" alt="<?= esc($c['course_name']) ?>" class="enrolled-course-image">
                                <div style="position: absolute; top: 10px; right: 10px; background: rgba(40, 167, 69, 0.95); color: white; padding: 5px 12px;
                                 border-radius: 20px; font-size: 12px; font-weight: 600;">
                                    <i class="fas fa-check-circle me-1"></i>Completed
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="enrolled-course-image-container enrolled-course-placeholder">
                                <div class="enrolled-course-placeholder-icon"><i class="fas fa-book fa-3x"></i></div>
                                <div style="position: absolute; top: 10px; right: 10px; background: rgba(40, 167, 69, 0.95); color: white; padding: 5px 12px; 
                                border-radius: 20px; font-size: 12px; font-weight: 600;">
                                    <i class="fas fa-check-circle me-1"></i>Completed
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="enrolled-course-content">
                            <h3 class="enrolled-course-title"><?= esc($c['course_name']) ?></h3>
                            <p class="enrolled-course-desc">
                                <?= esc(substr($c['course_desc'], 0, 100)) ?><?= strlen($c['course_desc']) > 100 ? '...' : '' ?>
                            </p>
                            
                            <?php if (isset($c['progress'])): ?>
                                <div class="enrolled-progress-section">
                                    <div class="enrolled-progress-info">
                                        <span class="enrolled-progress-label"><i class="fas fa-check-circle me-1"></i>Progress</span>
                                        <span class="enrolled-progress-value"><?= esc($c['progress']) ?>%</span>
                                    </div>
                                    <div class="enrolled-progress-bar">
                                        <div class="enrolled-progress-fill" style="width: <?= esc($c['progress']) ?>%"></div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="enrolled-course-footer">
                                <span class="enrolled-status-badge enrolled-status-completed">
                                    <i class="fas fa-trophy me-1"></i><?= esc($c['status']) ?>
                                </span>
                            </div>

                            <?php if ($c['status'] === 'Completed'): ?>
                                <div class="mt-3">
                                    <a href="<?= site_url('courses/certificate/' . $c['course_id']) ?>" 
                                       class="btn btn-success btn-sm w-100" 
                                       onclick="event.stopPropagation();">
                                        <i class="fas fa-certificate me-1"></i>Download Certificate
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="enrolled-empty-state fade-in-up" style="animation-delay: 0.2s;">
                <div class="enrolled-empty-icon"><i class="fas fa-trophy fa-4x"></i></div>
                <h3 class="enrolled-empty-title">No Completed Courses Yet</h3>
                <p class="enrolled-empty-desc">Complete your enrolled courses to see them here!</p>
                <a href="<?= site_url('courses/enrolled') ?>" class="enrolled-empty-btn"><i class="fas fa-book me-2"></i>View Enrolled Courses</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('body').addClass('animated-background');
        
        $('.fade-in-up').each(function(index) {
            $(this).css('opacity', '1');
        });
    });
</script>