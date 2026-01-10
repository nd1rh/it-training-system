<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | StartIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 70px;
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .section {
            padding: 60px 0;
        }

        h1,
        h2,
        h3 {
            font-weight: 700;
        }

        .lead {
            font-size: 1.1rem;
            color: #555;
        }

        /* Mission, Vision, Values Cards */
        .card-feature {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            padding: 30px 20px;
            margin-bottom: 30px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-feature:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .card-feature h3 {
            color: #0d6efd;
            margin-bottom: 15px;
        }

        .card-feature p {
            color: #555;
        }

        /* Team Section */
        .team-member {
            text-align: center;
            margin-bottom: 40px;
            transition: transform 0.3s;
        }

        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 4px solid #0d6efd;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .team-member img:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .team-member h5 {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .team-member p {
            color: #0d6efd;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .team-member img {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>

<body>

    <div class="container section">
        <h1 class="text-center mb-4">About StartIT</h1>
        <p class="lead text-center mb-5">
            StartIT is an online training platform designed to help individuals learn, enroll, and track their IT courses easily.
            Our platform provides a smooth learning experience for both trainees and trainers.
        </p>

        <div class="row mb-5">
            <div class="col-md-4">
                <div class="card-feature text-center">
                    <h3>Our Mission</h3>
                    <p>Empower learners with quality IT courses and enable trainers to manage and deliver their content efficiently.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-feature text-center">
                    <h3>Our Vision</h3>
                    <p>To be the leading online IT training platform in the region, fostering skills development and career growth.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-feature text-center">
                    <h3>Our Values</h3>
                    <p>Innovation, quality, collaboration, and continuous learning are at the heart of everything we do.</p>
                </div>
            </div>
        </div>

        <h2 class="text-center mb-4">Our Team</h2>
        <div class="row">
            <div class="col-md-3 team-member">
                <img src="<?= base_url('assets/images/afiqah.jpeg') ?>" alt="Nurulain Afiqah">
                <h5>Nurulain Afiqah binti Rameli</h5>
                <p>Project Manager</p>
            </div>
            <div class="col-md-3 team-member">
                <img src="<?= base_url('assets/images/nad.jpeg') ?>" alt="Aina Nadirah">
                <h5>Aina Nadirah binti Kamarul Bahrin</h5>
                <p>Web Developer</p>
            </div>
            <div class="col-md-3 team-member">
                <img src="<?= base_url('assets/images/nurina.jpeg') ?>" alt="Nurina Afiqah">
                <h5>Nurina Afiqah binti Zulkifli</h5>
                <p>UI/UX Designer</p>
            </div>
            <div class="col-md-3 team-member">
                <img src="<?= base_url('assets/images/dijah.jpg') ?>" alt="Zukhruful Khadijah">
                <h5>Zukhruful Khadijah Amni binti Jamnul Azhar</h5>
                <p>System Analyst</p>
            </div>
        </div>
    </div>

</body>

</html>