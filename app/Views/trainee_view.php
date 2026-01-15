<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trainee Details</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body>

    <!-- Animated Background Elements -->
    <div class="bg-animation">
        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>
        <div class="bg-circle bg-circle-4"></div>
    </div>

    <div class="container" style="position: relative; z-index: 1; padding-top: 20px; padding-bottom: 20px;">
        <h1 class="page-title mb-3" style="margin-top: 0;">Trainee Details</h1>

        <div class="position-relative" style="max-width: 500px; margin: 0 auto 20px auto;">
            <i class="fas fa-search position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 10;"></i>
            <input type="text" id="search" class="form-control mb-3" placeholder="Search by Name, Email or Course" style="padding-left: 45px;">
        </div>

        <div class="table-responsive" style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px); border-radius: 15px; padding: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Course</th>
                        <th>Payment Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="traineeData">
                    <?php if (!empty($trainees)): ?>
                        <?php foreach ($trainees as $row): ?>
                            <?php 
                                $status = $row['payment_status'] ?? 'UNPAID';
                                // Convert "Success" to "Paid"
                                if (strtoupper($status) === 'SUCCESS') {
                                    $status = 'PAID';
                                }
                                $coursePrice = floatval($row['price'] ?? 0);
                                $isFreeCourse = $coursePrice <= 0;
                            ?>
                            <tr>
                                <td><?= esc($row['trainee_id']) ?></td>
                                <td><?= esc($row['full_name']) ?></td>
                                <td><?= esc($row['email']) ?></td>
                                <td><?= esc($row['gender'] ?? '-') ?></td>
                                <td><?= esc($row['course_name'] ?? '-') ?></td>
                                <td>
                                    <?php if (!$isFreeCourse): ?>
                                        <span class="badge <?= strtoupper($status) === 'PAID' ? 'badge-paid' : 'badge-unpaid' ?>">
                                            <i class="fas <?= strtoupper($status) === 'PAID' ? 'fa-check-circle' : 'fa-times-circle' ?> me-1"></i><?= strtoupper($status) === 'PAID' ? 'Paid' : 'Unpaid' ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted"><i class="fas fa-gift me-1"></i>Free</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex gap-2" style="white-space: nowrap;">
                                        <a href="<?= base_url('configure/trainee/edit/' . $row['trainee_id']) ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit me-1"></i>Edit</a>
                                        <a href="<?= base_url('configure/trainee/delete/' . $row['trainee_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this trainee? This will also remove all their course enrollments.');"><i class="fas fa-trash me-1"></i>Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No trainees found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').keyup(function() {
                let keyword = $(this).val();

                $.ajax({
                    url: "<?= base_url('configure/trainee/search') ?>",
                    method: "GET",
                    data: {
                        keyword: keyword
                    },
                    dataType: "json",
                    success: function(data) {
                        let html = '';
                        if (data.length > 0) {
                            data.forEach(function(row) {
                                let status = row.payment_status ?? 'UNPAID';
                                // Convert "Success" to "Paid"
                                if (status.toUpperCase() === 'SUCCESS') {
                                    status = 'PAID';
                                }
                                
                                let coursePrice = parseFloat(row.price || 0);
                                let isFreeCourse = coursePrice <= 0;
                                
                                let badge = '';
                                if (isFreeCourse) {
                                    badge = '<span class="text-muted"><i class="fas fa-gift me-1"></i>Free</span>';
                                } else {
                                    badge = status.toUpperCase() === 'PAID' ?
                                        '<span class="badge badge-paid"><i class="fas fa-check-circle me-1"></i>Paid</span>' :
                                        '<span class="badge badge-unpaid"><i class="fas fa-times-circle me-1"></i>Unpaid</span>';
                                }

                                html += `
                                    <tr>
                                        <td>${row.trainee_id}</td>
                                        <td>${row.full_name}</td>
                                        <td>${row.email}</td>
                                        <td>${row.gender ?? '-'}</td>
                                        <td>${row.course_name ?? '-'}</td>
                                        <td>${badge}</td>
                                        <td>
                                            <div class="d-flex gap-2" style="white-space: nowrap;">
                                                <a href="<?= base_url('configure/trainee/edit/') ?>${row.trainee_id}" class="btn btn-sm btn-primary"><i class="fas fa-edit me-1"></i>Edit</a>
                                                <a href="<?= base_url('configure/trainee/delete/') ?>${row.trainee_id}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this trainee? This will also remove all their course enrollments.');"><i class="fas fa-trash me-1"></i>Delete</a>
                                            </div>
                                        </td>
                                    </tr>`;
                            });
                        } else {
                            html = `<tr><td colspan="7" class="text-center">No trainees found.</td></tr>`;
                        }
                        $('#traineeData').html(html);
                    }
                });
            });
        });

        // Add animated background class to body
        $('body').addClass('animated-background');
    </script>
</body>

</html>