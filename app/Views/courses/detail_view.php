<div class="container mt-5">
    <?php if ($course): ?>
        <h2><?= esc($course['course_name']) ?></h2>
        <p><?= esc($course['course_desc']) ?></p>
        <p><strong>Duration:</strong> <?= esc($course['course_duration']) ?> hours</p>
        <p><strong>Price:</strong> RM <?= esc($course['price']) ?></p>
        <a href="<?= site_url('enrolled') ?>" class="btn btn-secondary mt-3">Back</a>
    <?php else: ?>
        <p>Course not found.</p>
    <?php endif; ?>
</div>