<div class="container mt-5">
    <h2 class="mb-4">Courses Enrolled</h2>

    <?php if (!empty($courses)): ?>
        <div class="row g-3">
            <?php foreach ($courses as $c): ?>
                <div class="col-md-4 col-sm-6">
                    <div class="course-box" onclick="location.href='<?= site_url('courses/detail/' . $c['course_id']) ?>'">
                        <h5><?= esc($c['course_name']) ?></h5>
                        <p><?= esc(substr($c['course_desc'], 0, 50)) ?>...</p>
                        <span class="badge bg-primary"><?= esc($c['status']) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No enrolled courses yet.</p>
    <?php endif; ?>
</div>