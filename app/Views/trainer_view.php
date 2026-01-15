<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trainer Details</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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

    <div class="container mt-5" style="position: relative; z-index: 1; padding-top: 100px;">
        <h1 class="text-center page-title">Our Trainers</h1>

        <div class="row g-4">
            <?php if (!empty($trainers)): ?>
                <?php foreach ($trainers as $trainer): ?>

                    <?php
                    $trainerImg = $trainer['profile_pic'] ?? 'uploads/trainers/default.png';
                    ?>

                    <div class="col-md-3 col-sm-6">
                        <div class="trainer-card">

                            <!-- Trainer Image -->
                            <img
                                src="<?= base_url($trainerImg) ?>"
                                alt="<?= esc($trainer['full_name']) ?>"
                                class="trainer-avatar">

                            <h4><?= esc($trainer['full_name']) ?></h4>
                            <p><strong>Email:</strong> <?= esc($trainer['email']) ?></p>
                            <p><strong>Specialization:</strong> <?= esc($trainer['specialization'] ?? 'N/A') ?></p>
                            <p><strong>Experience:</strong> <?= esc($trainer['experience_years'] ?? 'N/A') ?> years</p>

                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-muted">No trainers available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('body').addClass('animated-background');
        });
    </script>

</body>

</html>