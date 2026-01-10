<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trainee Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .badge-paid {
            background-color: #198754;
        }

        .badge-unpaid {
            background-color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="page-title mb-4">Trainee Details</h1>

        <input type="text" id="search" class="form-control mb-3" placeholder="Search by Name, Email or Course">

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
                        <?php $status = $row['payment_status'] ?? 'UNPAID'; ?>
                        <tr>
                            <td><?= esc($row['trainee_id']) ?></td>
                            <td><?= esc($row['full_name']) ?></td>
                            <td><?= esc($row['email']) ?></td>
                            <td><?= esc($row['gender'] ?? '-') ?></td>
                            <td><?= esc($row['course_name'] ?? '-') ?></td>
                            <td>
                                <?php if ($status === 'PAID'): ?>
                                    <span class="badge badge-paid">Paid</span>
                                <?php else: ?>
                                    <span class="badge badge-unpaid">Unpaid</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
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
                                let badge = (status === 'PAID') ?
                                    '<span class="badge badge-paid">Paid</span>' :
                                    '<span class="badge badge-unpaid">Unpaid</span>';

                                html += `
                            <tr>
                                <td>${row.trainee_id}</td>
                                <td>${row.full_name}</td>
                                <td>${row.email}</td>
                                <td>${row.gender ?? '-'}</td>
                                <td>${row.course_name ?? '-'}</td>
                                <td>${badge}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        `;
                            });
                        } else {
                            html = `<tr><td colspan="7" class="text-center">No trainees found.</td></tr>`;
                        }

                        $('#traineeData').html(html);
                    }
                });
            });
        });
    </script>
</body>

</html>