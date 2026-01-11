<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | StartIT</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Main CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body class="about-body">

    <div class="container">

        <!-- About Intro -->
        <h1 class="text-center about-title">About StartIT</h1>
        <p class="about-lead text-center">
            StartIT is an online training platform designed to help individuals learn, enroll,
            and track their IT courses easily. Our platform provides a smooth learning
            experience for both trainees and trainers.
        </p>

        <!-- Mission / Vision / Values -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card-feature">
                    <h3>Our Mission</h3>
                    <p>
                        Empower learners with high-quality IT courses and enable trainers
                        to manage and deliver their content efficiently.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-feature">
                    <h3>Our Vision</h3>
                    <p>
                        To become a leading online IT training platform that supports
                        skills development and long-term career growth.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-feature">
                    <h3>Our Values</h3>
                    <p>
                        Innovation, quality, collaboration, and continuous learning
                        guide everything we do.
                    </p>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <h2 class="text-center team-title">Our Team</h2>

        <div class="row g-4 justify-content-center">
            <div class="col-md-3 col-sm-6 team-member">
                <img src="<?= base_url('assets/images/afiqah.jpeg') ?>" alt="Nurulain Afiqah">
                <h5>Nurulain Afiqah binti Rameli</h5>
                <p>Project Manager</p>
            </div>

            <div class="col-md-3 col-sm-6 team-member">
                <img src="<?= base_url('assets/images/nad.jpeg') ?>" alt="Aina Nadirah">
                <h5>Aina Nadirah binti Kamarul Bahrin</h5>
                <p>Web Developer</p>
            </div>

            <div class="col-md-3 col-sm-6 team-member">
                <img src="<?= base_url('assets/images/nurina.jpeg') ?>" alt="Nurina Afiqah">
                <h5>Nurina Afiqah binti Zulkifli</h5>
                <p>UI/UX Designer</p>
            </div>

            <div class="col-md-3 col-sm-6 team-member">
                <img src="<?= base_url('assets/images/dijah.jpeg') ?>" alt="Zukhruful Khadijah">
                <h5>Zukhruful Khadijah Amni binti Jamnul Azhar</h5>
                <p>System Analyst</p>
            </div>
        </div>

    </div>

</body>

</html>