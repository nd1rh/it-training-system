<div class="container mt-5 text-center">
    <h1>Certificate of Completion</h1>
    <p>This certifies that <strong><?= esc($full_name) ?></strong></p>
    <p>has successfully completed the course</p>
    <h2><?= esc($course_name) ?></h2>
    <p>on <?= date('d M Y', strtotime($completed_date)) ?></p>

    <a href="#" onclick="window.print()" class="btn btn-primary mt-3">Print / Save PDF</a>
</div>