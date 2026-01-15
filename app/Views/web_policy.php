<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Web Policy | StartIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/web-policy.css') ?>" rel="stylesheet">
</head>

<body class="web-policy-body">

    <!-- Animated Background Elements -->
    <div class="bg-animation">
        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>
        <div class="bg-circle bg-circle-4"></div>
    </div>

    <div class="policy-container" style="position: relative; z-index: 1; padding-top: 100px;">

        <div class="policy-card">

            <h1 class="policy-title">Web Policy</h1>

            <div class="row">
                <div class="col-12">

                    <section class="policy-section">
                        <h2>1. Privacy Policy</h2>
                        <p>StartIT respects your privacy. Any personal information collected during registration or course participation is securely stored and used solely to enhance your learning experience. We do not share your personal data with third parties without your consent, except where required by law.</p>
                    </section>

                    <section class="policy-section">
                        <h2>2. Terms of Use</h2>
                        <p>Users of StartIT must agree to use the platform responsibly. All course content is for personal and educational purposes only. Unauthorized distribution, copying, or commercial use of our content is strictly prohibited.</p>
                    </section>

                    <section class="policy-section">
                        <h2>3. Intellectual Property</h2>
                        <p>All materials, including courses, videos, documents, and software provided by StartIT, are protected by copyright and intellectual property laws. Users are granted a limited license to access and use the materials for learning purposes only.</p>
                    </section>

                    <section class="policy-section">
                        <h2>4. Security</h2>
                        <p>We take the security of our users seriously. StartIT implements industry-standard security measures to protect your data and prevent unauthorized access. Users are responsible for maintaining the confidentiality of their login credentials.</p>
                    </section>

                    <section class="policy-section">
                        <h2>5. Disclaimer</h2>
                        <p>While we strive to provide accurate and up-to-date information, StartIT is not responsible for any outcomes resulting from the use of our platform. Users should verify information independently and apply their learning responsibly.</p>
                    </section>

                </div>
            </div>
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