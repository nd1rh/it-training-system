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

<body>

    <!-- Animated Background Elements -->
    <div class="bg-animation">
        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>
        <div class="bg-circle bg-circle-4"></div>
    </div>

    <!-- =========================
         ABOUT PAGE
    ========================== -->
    <div class="container about-page" style="position: relative; z-index: 1;">

        <!-- =========================
             INTRO SECTION
        ========================== -->
        <section class="about-intro text-center">
            <h1 class="about-title">About StartIT</h1>
            <p class="about-lead">
                StartIT is an online training platform designed to help individuals learn,
                enroll, and track IT courses with ease. Our platform delivers a seamless
                learning experience for both trainees and trainers.
            </p>
        </section>

        <!-- =========================
             MISSION / VISION / VALUES
        ========================== -->
        <section class="about-container">
            <div class="row g-4">

                <div class="col-md-4">
                    <div class="about-card">
                        <h3>Our Mission</h3>
                        <p>
                            To empower learners through high-quality IT courses while enabling
                            trainers to efficiently manage and deliver impactful content.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="about-card">
                        <h3>Our Vision</h3>
                        <p>
                            To become a leading online IT training platform that supports
                            lifelong learning and sustainable career growth.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="about-card">
                        <h3>Our Values</h3>
                        <p>
                            Innovation, quality, collaboration, and continuous improvement
                            guide everything we do.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <!-- =========================
             TEAM SECTION
        ========================== -->
        <section class="about-team">
            <h2 class="team-title text-center">Our Team</h2>

            <div class="row g-4 justify-content-center">

                <div class="col-md-3 col-sm-6 team-member">
                    <img src="<?= base_url('assets/images/afiqah.jpeg') ?>" alt="Nurulain Afiqah">
                    <h5>Nurulain Afiqah</h5>
                    <p>Project Manager</p>
                </div>

                <div class="col-md-3 col-sm-6 team-member">
                    <img src="<?= base_url('assets/images/nad.jpeg') ?>" alt="Aina Nadirah">
                    <h5>Aina Nadirah</h5>
                    <p>Web Developer</p>
                </div>

                <div class="col-md-3 col-sm-6 team-member">
                    <img src="<?= base_url('assets/images/nurina.jpeg') ?>" alt="Nurina Afiqah">
                    <h5>Nurina Afiqah</h5>
                    <p>UI/UX Designer</p>
                </div>

                <div class="col-md-3 col-sm-6 team-member">
                    <img src="<?= base_url('assets/images/dijah.jpeg') ?>" alt="Zukhruful Khadijah">
                    <h5>Zukhruful Khadijah</h5>
                    <p>System Analyst</p>
                </div>

            </div>
        </section>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('body').addClass('animated-background');
        });
    </script>

</body>

</html>