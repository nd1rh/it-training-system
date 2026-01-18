<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trainee Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body>

    <div class="bg-animation">
        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>
        <div class="bg-circle bg-circle-4"></div>
    </div>

    <div class="container" style="position: relative; z-index: 1; padding-top: 20px; padding-bottom: 20px;">
        <h1 class="page-title mb-3" style="margin-top: 0;">Trainee Details</h1>

        <div class="position-relative">
            <i class="fas fa-search position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 10;"></i>
            <input type="text" id="search" class="form-control mb-3" placeholder="Search by Name, Email or Course" style="padding-left: 45px;">
        </div>

        <div class="table-responsive" style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px); border-radius: 15px; padding: 20px; 
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Course</th>
                        <th>Course Status</th>
                        <th>Payment Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="traineeData">
                    <?php if (!empty($trainees)): ?>
                        <?php foreach ($trainees as $row): ?>
                            <?php
                            $payment = strtoupper($row['payment_status'] ?? 'UNPAID');
                            if ($payment === 'SUCCESS') $payment = 'PAID';
                            $coursePrice = floatval($row['price'] ?? 0);
                            $isFreeCourse = $coursePrice <= 0;

                            $courseStatusRaw = $row['course_status'] ?? 'Enrolled';
                            $courseStatus = str_replace(' ', '_', strtolower($courseStatusRaw));

                            switch ($courseStatus) {
                                case 'in_progress':
                                    $statusBadge = '<span class="badge bg-warning text-dark">In Progress</span>';
                                    break;
                                case 'completed':
                                    $statusBadge = '<span class="badge bg-success">Completed</span>';
                                    break;
                                default:
                                    $statusBadge = '<span class="badge bg-secondary">Enrolled</span>';
                            }
                            ?>
                            <tr>
                                <td><?= esc($row['trainee_id']) ?></td>
                                <td><?= esc($row['full_name']) ?></td>
                                <td><?= esc($row['email']) ?></td>
                                <td><?= esc($row['phone_num'] ?? '-') ?></td>
                                <td><?= esc($row['course_name'] ?? '-') ?></td>
                                <td><?= $statusBadge ?></td>
                                <td>
                                    <?php if (!$isFreeCourse): ?>
                                        <span class="badge <?= $payment === 'PAID' ? 'badge-paid' : 'badge-unpaid' ?>">
                                            <i class="fas <?= $payment === 'PAID' ? 'fa-check-circle' : 'fa-times-circle' ?> me-1"></i><?= $payment ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted"><i class="fas fa-gift me-1"></i>Free</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?= base_url('configure/trainee/edit/' . $row['trainee_id']) ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit me-1"></i>
                                        Edit</a>
                                        <a href="<?= base_url('configure/trainee/delete/' . $row['trainee_id']) ?>" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Are you sure? This will delete all enrollments.');"><i class="fas fa-trash me-1"></i>Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">No trainees found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $('#search').keyup(function() {
            let keyword = $(this).val();
            $.ajax({
                url: "<?= base_url('configure/trainee/search') ?>",
                method: "GET",
                data: {
                    keyword
                },
                dataType: "json",
                success: function(data) {
                    let html = '';
                    if (data.length > 0) {
                        data.forEach(function(row) {
                            let payment = (row.payment_status ?? 'UNPAID').toUpperCase();
                            if (payment === 'SUCCESS') payment = 'PAID';
                            let isFree = parseFloat(row.price || 0) <= 0;
                            let paymentBadge = isFree ? '<span class="text-muted"><i class="fas fa-gift me-1"></i>Free</span>' :
                                (payment === 'PAID' ? '<span class="badge badge-paid"><i class="fas fa-check-circle me-1"></i>Paid</span>' :
                                    '<span class="badge badge-unpaid"><i class="fas fa-times-circle me-1"></i>Unpaid</span>');

                            let courseStatusRaw = row.course_status ?? 'Enrolled';
                            let courseStatus = courseStatusRaw.toLowerCase().replace(' ', '_');
                            let statusBadge = '';
                            switch (courseStatus) {
                                case 'in_progress':
                                    statusBadge = '<span class="badge bg-warning text-dark">In Progress</span>';
                                    break;
                                case 'completed':
                                    statusBadge = '<span class="badge bg-success">Completed</span>';
                                    break;
                                default:
                                    statusBadge = '<span class="badge bg-secondary">Enrolled</span>';
                                    break;
                            }

                            html += `<tr>
                        <td>${row.trainee_id}</td>
                        <td>${row.full_name}</td>
                        <td>${row.email}</td>
                        <td>${row.phone_num ?? '-'}</td>
                        <td>${row.course_name ?? '-'}</td>
                        <td>${statusBadge}</td>
                        <td>${paymentBadge}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?= base_url('configure/trainee/edit/') ?>${row.trainee_id}" class="btn btn-sm btn-primary"><i class="fas fa-edit me-1"></i>Edit</a>
                                <a href="<?= base_url('configure/trainee/delete/') ?>${row.trainee_id}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');"><i class="fas fa-trash me-1"></i>Delete</a>
                            </div>
                        </td>
                    </tr>`;
                        });
                    } else {
                        html = `<tr><td colspan="8" class="text-center">No trainees found.</td></tr>`;
                    }
                    $('#traineeData').html(html);
                }
            });
        });

        $('body').addClass('animated-background');
    </script>
</body>

</html>