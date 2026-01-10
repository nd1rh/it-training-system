<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trainers Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 70px;
            background: #f1f3f6;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h1 {
            font-weight: 600;
            color: #343a40;
        }

        .trainer-card {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .trainer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .trainer-card img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #0d6efd;
        }

        .trainer-card h4 {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .trainer-card p {
            color: #6c757d;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-5">Our Trainers</h1>
        <div class="row g-4">
            <?php if (!empty($trainers)): ?>
                <?php foreach ($trainers as $trainer): ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="trainer-card">
                            <h4><?= esc($trainer['full_name']) ?></h4>
                            <p><strong>Email:</strong> <?= esc($trainer['email']) ?></p>
                            <p><strong>Specialization:</strong> <?= esc($trainer['specialization'] ?? 'N/A') ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No trainers available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>