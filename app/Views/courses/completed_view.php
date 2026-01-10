<div class="container mt-5">
    <h2 class="mb-4">Courses Completed</h2>

    <?php if (!empty($courses)): ?>
        <div class="row g-3">
            <?php foreach ($courses as $c): ?>
                <div class="col-md-4 col-sm-6">
                    <div class="course-box p-3">
                        <h5><?= esc($c['course_name']) ?></h5>
                        <p><?= esc(substr($c['course_desc'], 0, 50)) ?>...</p>
                        <span class="badge bg-success"><?= esc($c['status']) ?></span>

                        <!-- Certificate Button -->
                        <?php if ($c['status'] === 'Completed'): ?>
                            <div class="mt-2">
                                <a href="<?= site_url('courses/certificate/' . $c['course_id']) ?>"
                                    class="btn btn-sm btn-outline-primary">
                                    Download Certificate
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No completed courses yet.</p>
    <?php endif; ?>
</div>