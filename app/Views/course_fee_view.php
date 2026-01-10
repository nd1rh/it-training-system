<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Course Fees Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        h1 {
            padding-top: 80px; 
        }

        /* 1. REMOVED overflow:hidden to allow scrolling */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f8f9fa;
            overflow-y: auto; /* Forces vertical scroll to be available */
        }

        .badge-free { background-color: #198754; }
        .badge-paid { background-color: #0d6efd; }
        .price-text { font-weight: bold; }

        /* 2. Optimized Table Container */
        .table-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-height: 600px; /* Adjust this height as needed */
            overflow-y: auto; 
            border: 1px solid #dee2e6;
        }

        /* 3. Keep Header Fixed while scrolling */
        thead.table-dark {
            position: sticky;
            top: 0;
            z-index: 10;
        }
    </style>
</head>

<body>
    <div class="container mt-5"> 
        <h1 class="page-title mb-4">Course Fees Details</h1>

        <input type="text" id="search" class="form-control mb-3" placeholder="Search by Course Name or Description">

        <div class="table-container">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Course Name</th>
                        <th>Description</th>
                        <th>Duration (Hrs)</th>
                        <th>Price</th>
                        <th>Actions</th>
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
                                        <span class="badge badge-free">Free</span>
                                    <?php else: ?>
                                        <span class="price-text">$<?= number_format($row['price'], 2) ?></span>
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
                            <td colspan="6" class="text-center">No courses found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div> <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').keyup(function() {
                let keyword = $(this).val();

                $.ajax({
                    // IMPORTANT: Ensure this matches the route in Routes.php (underscore vs hyphen)
                    url: "<?= base_url('configure/course_fee/search') ?>", 
                    method: "GET",
                    data: { keyword: keyword },
                    dataType: "json",
                    success: function(data) {
                        let html = '';
                        if (data.length > 0) {
                            data.forEach(function(row) {
                                let priceDisplay = (parseFloat(row.price) <= 0) ?
                                    '<span class="badge badge-free">Free</span>' :
                                    `<span class="price-text">$${parseFloat(row.price).toFixed(2)}</span>`;

                                html += `
                                <tr>
                                    <td>${row.course_id}</td>
                                    <td>${row.course_name}</td>
                                    <td>${row.course_desc}</td>
                                    <td>${row.course_duration}</td>
                                    <td>${priceDisplay}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>`;
                            });
                        } else {
                            html = `<tr><td colspan="6" class="text-center">No courses found.</td></tr>`;
                        }
                        $('#courseData').html(html);
                    }
                });
            });
        });
    </script>
</body>
</html>