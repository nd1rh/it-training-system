<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Course Details | StartIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Main CSS -->
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

    <!-- =========================
         COURSE DETAILS PAGE
    ========================== -->
    <div class="container course-page" style="position: relative; z-index: 1;">

        <!-- Page Title -->
        <section class="course-header">
            <h1 class="page-title text-center">Course Details</h1>
        </section>

        <!-- Search -->
        <section class="course-search mb-4">
            <div class="position-relative">
                <i class="fas fa-search position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 10;"></i>
                <input
                    type="text"
                    id="search"
                    class="form-control search-input"
                    placeholder="Search by Course Name or Description"
                    style="padding-left: 45px;">
            </div>
        </section>

        <!-- Add New Course Button -->
        <div class="d-flex gap-2 justify-content-center" style="white-space: nowrap; margin-bottom: 20px;">
            <a href="<?= base_url('configure/course/add') ?>" class="btn btn-success fw-bold">
                <i class="fas fa-plus me-1"></i> Add New Course
            </a>
        </div>

        <!-- Table -->
        <section class="course-table">
            <div class="table-container" style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px); border-radius: 15px; padding: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Course Name</th>
                            <th>Description</th>
                            <th>Duration (Hrs)</th>
                            <th>Price (RM)</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody id="courseData">
                        <?php if (!empty($courses)): ?>
                            <?php foreach ($courses as $row): ?>
                                <tr>
                                    <td><?= esc($row['course_id']) ?></td>
                                    <td><?= esc($row['course_name']) ?></td>
                                    <td><?= esc($row['course_desc']) ?></td>
                                    <td><?= esc($row['course_duration']) ?></td>
                                    <td>
                                        <?php if ($row['price'] <= 0): ?>
                                            <span class="badge badge-free"><i class="fas fa-gift me-1"></i>Free</span>
                                        <?php else: ?>
                                            <span class="price-text">
                                                <i class="fas fa-money-bill-wave me-1"></i><?= number_format($row['price'], 2) ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center" style="white-space: nowrap;">
                                            <a href="<?= base_url('configure/course/edit/' . $row['course_id']) ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit me-1"></i>Edit</a>
                                            <a href="<?= base_url('configure/course/delete/' . $row['course_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this course?');"><i class="fas fa-trash me-1"></i>Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No courses found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </section>

    </div>

    <!-- =========================
         SCRIPTS
    ========================== -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#search').keyup(function() {
                let keyword = $(this).val();

                $.ajax({
                    url: "<?= base_url('configure/course/search') ?>",
                    method: "GET",
                    data: {
                        keyword: keyword
                    },
                    dataType: "json",
                    success: function(data) {
                        let html = '';

                        if (data.length > 0) {
                            data.forEach(function(row) {

                                let priceDisplay =
                                    parseFloat(row.price) <= 0 ?
                                    '<span class="badge badge-free"><i class="fas fa-gift me-1"></i>Free</span>' :
                                    `<span class="price-text"><i class="fas fa-money-bill-wave me-1"></i>${parseFloat(row.price).toFixed(2)}</span>`;

                                html += `
                                <tr>
                                    <td>${row.course_id}</td>
                                    <td>${row.course_name}</td>
                                    <td>${row.course_desc}</td>
                                    <td>${row.course_duration}</td>
                                    <td>${priceDisplay}</td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center" style="white-space: nowrap;">
                                            <a href="<?= base_url('configure/course/edit/') ?>${row.course_id}" class="btn btn-sm btn-primary"><i class="fas fa-edit me-1"></i>Edit</a>
                                            <a href="<?= base_url('configure/course/delete/') ?>${row.course_id}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this course?');"><i class="fas fa-trash me-1"></i>Delete</a>
                                        </div>
                                    </td>
                                </tr>`;
                            });
                        } else {
                            html = `
                                <tr>
                                    <td colspan="6" class="text-center">
                                        No courses found.
                                    </td>
                                </tr>`;
                        }

                        $('#courseData').html(html);
                    }
                });
            });

            // Add animated background class to body
            $('body').addClass('animated-background');
        });
    </script>

</body>

</html>