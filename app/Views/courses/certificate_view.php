<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion | StartIT</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>

    <div class="certificate-wrapper">

        <div class="certificate-container">

            <div class="certificate-border"></div>
            <div class="certificate-inner-border"></div>

            <div class="corner-decoration corner-top-left"></div>
            <div class="corner-decoration corner-top-right"></div>
            <div class="corner-decoration corner-bottom-left"></div>
            <div class="corner-decoration corner-bottom-right"></div>

            <div class="certificate-header">
                <div class="certificate-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <h1>Certificate of Completion</h1>
                <div class="header-line"></div>
            </div>

            <div class="certificate-body">
                <p class="certify-text">This is to certify that</p>

                <h2 class="recipient-name"><?= esc($full_name) ?></h2>

                <p class="certify-text">has successfully completed the course</p>

                <h3 class="course-name"><?= esc($course_name) ?></h3>

                <div class="completion-date">
                    <i class="fas fa-calendar-check"></i>
                    <span>Completed on <?= date('F d, Y', strtotime($completed_date)) ?></span>
                </div>
            </div>

            <div class="certificate-footer">
                <div class="signature-left">
                    <div class="signature-line"></div>
                    <p><i class="fas fa-user-tie"></i>Trainer</p>
                    <p>Signature</p>
                </div>

                <div class="certificate-seal">
                    <div class="seal-circle">
                        <div class="seal-inner">
                            <i class="fas fa-stamp"></i>
                        </div>
                    </div>
                    <p class="seal-name">StartIT</p>
                    <p class="seal-label">Official Seal</p>
                </div>

                <div class="signature-right">
                    <div class="signature-line"></div>
                    <p><i class="fas fa-certificate"></i>Authorized</p>
                    <p>Date: <?= date('M d, Y', strtotime($completed_date)) ?></p>
                </div>
            </div>
        </div>

        <div class="certificate-actions">
            <button class="print-btn" onclick="window.print()">
                <i class="fas fa-print"></i> Print / Save PDF
            </button>
        </div>
    </div>

</body>

</html>