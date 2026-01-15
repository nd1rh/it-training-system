<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion | StartIT</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    
    <style>
        @page {
            size: A4 portrait;
            margin: 10mm;
        }
        
        @media print {
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
            }
            
            body {
                background: white !important;
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
                height: 100% !important;
            }
            
            .certificate-actions {
                display: none !important;
            }
            
            .certificate-wrapper {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
                page-break-inside: avoid !important;
                page-break-after: avoid !important;
            }
            
            .certificate-container {
                width: 100% !important;
                max-width: 100% !important;
                height: calc(100vh - 20mm) !important;
                max-height: calc(100vh - 20mm) !important;
                padding: 25px 40px !important;
                margin: 0 !important;
                box-shadow: none !important;
                border-radius: 0 !important;
                page-break-inside: avoid !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: space-between !important;
                overflow: hidden !important;
            }
            
            .certificate-border {
                border-radius: 0 !important;
            }
            
            .certificate-inner-border {
                border-radius: 0 !important;
            }
            
            .certificate-header {
                margin-bottom: 15px !important;
                flex-shrink: 0 !important;
            }
            
            .certificate-header h1 {
                font-size: 32px !important;
                margin: 0 !important;
                line-height: 1.2 !important;
                color: #D4AF37 !important;
            }
            
            .certificate-header i {
                font-size: 35px !important;
                margin-bottom: 10px !important;
                color: #D4AF37 !important;
            }
            
            .certificate-header div[style*="width: 250px"] {
                width: 150px !important;
                margin: 10px auto !important;
            }
            
            .certificate-body {
                margin: 15px 0 !important;
                flex: 1 !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: center !important;
                min-height: 0 !important;
            }
            
            .certificate-body p {
                font-size: 13px !important;
                margin: 8px 0 !important;
                line-height: 1.4 !important;
            }
            
            .recipient-name {
                font-size: 28px !important;
                margin: 12px 0 !important;
                padding: 12px 0 !important;
                line-height: 1.3 !important;
            }
            
            .course-name {
                font-size: 22px !important;
                margin: 12px 0 !important;
                line-height: 1.3 !important;
                color: #D4AF37 !important;
            }
            
            .certificate-body div[style*="margin: 25px"] i {
                color: #D4AF37 !important;
            }
            
            .certificate-body div[style*="margin: 25px"] {
                margin: 15px 0 !important;
            }
            
            .certificate-body div[style*="margin: 25px"] span {
                font-size: 13px !important;
            }
            
            .certificate-footer {
                margin-top: 15px !important;
                flex-shrink: 0 !important;
            }
            
            .certificate-footer p {
                font-size: 11px !important;
                margin: 3px 0 !important;
                line-height: 1.3 !important;
            }
            
            .certificate-footer div[style*="border-top"] {
                width: 150px !important;
                margin: 0 auto 8px !important;
                padding-top: 8px !important;
            }
            
            .certificate-seal div {
                width: 90px !important;
                height: 90px !important;
            }
            
            .certificate-seal div > div {
                width: 70px !important;
                height: 70px !important;
            }
            
            .certificate-seal i {
                font-size: 30px !important;
                color: #DC143C !important;
            }
            
            .certificate-seal p {
                color: #DC143C !important;
            }
            
            .certificate-footer div[style*="border-top"] {
                border-color: #D4AF37 !important;
            }
            
            .signature-left i,
            .signature-right i {
                color: #D4AF37 !important;
            }
            
            .signature-left p[style*="margin-top: 30px"],
            .signature-right p[style*="margin-top: 30px"] {
                margin-top: 20px !important;
            }
            
            .corner-decoration {
                display: none !important;
            }
            
            /* Prevent page breaks */
            .certificate-header,
            .certificate-body,
            .certificate-footer {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }
        }
    </style>
</head>

<body style="background: linear-gradient(135deg, #f5f5dc 0%, #fff8dc 100%); min-height: 100vh; padding: 40px 20px; margin: 0;">

    <div class="certificate-wrapper" style="max-width: 900px; margin: 0 auto; position: relative;">
        
        <!-- Certificate Container -->
        <div class="certificate-container" style="background: #ffffff; padding: 60px 80px; position: relative; box-shadow: 0 20px 60px rgba(0,0,0,0.2); border-radius: 8px; min-height: 600px; background-image: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(218,165,32,0.03) 2px, rgba(218,165,32,0.03) 4px);">
            
            <!-- Decorative Border - Gold -->
            <div class="certificate-border" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; border: 10px solid #D4AF37; border-radius: 8px; pointer-events: none; box-shadow: inset 0 0 0 2px #FFD700;"></div>
            <div class="certificate-inner-border" style="position: absolute; top: 25px; left: 25px; right: 25px; bottom: 25px; border: 2px solid #FFD700; border-radius: 4px; pointer-events: none;"></div>
            
            <!-- Decorative Corner Elements - Gold -->
            <div class="corner-decoration corner-top-left" style="position: absolute; top: 35px; left: 35px; width: 100px; height: 100px; border-top: 4px solid #D4AF37; border-left: 4px solid #D4AF37;"></div>
            <div class="corner-decoration corner-top-right" style="position: absolute; top: 35px; right: 35px; width: 100px; height: 100px; border-top: 4px solid #D4AF37; border-right: 4px solid #D4AF37;"></div>
            <div class="corner-decoration corner-bottom-left" style="position: absolute; bottom: 35px; left: 35px; width: 100px; height: 100px; border-bottom: 4px solid #D4AF37; border-left: 4px solid #D4AF37;"></div>
            <div class="corner-decoration corner-bottom-right" style="position: absolute; bottom: 35px; right: 35px; width: 100px; height: 100px; border-bottom: 4px solid #D4AF37; border-right: 4px solid #D4AF37;"></div>
            
            <!-- Certificate Header -->
            <div class="certificate-header" style="text-align: center; margin-bottom: 30px; position: relative; z-index: 1;">
                <div style="margin-bottom: 20px;">
                    <i class="fas fa-certificate" style="font-size: 60px; color: #D4AF37; opacity: 0.4;"></i>
                </div>
                <h1 style="font-family: 'Playfair Display', serif; font-size: 48px; font-weight: 900; color: #D4AF37; margin: 0; letter-spacing: 3px; text-transform: uppercase; text-shadow: 1px 1px 2px rgba(212,175,55,0.2);">
                    Certificate of Completion
                </h1>
                <div style="width: 250px; height: 3px; background: linear-gradient(90deg, transparent, #D4AF37, #FFD700, #D4AF37, transparent); margin: 20px auto; border-radius: 2px;"></div>
            </div>

            <!-- Certificate Body -->
            <div class="certificate-body" style="text-align: center; margin: 40px 0; position: relative; z-index: 1;">
                <p style="font-family: 'Open Sans', sans-serif; font-size: 18px; color: #555; margin-bottom: 20px; font-weight: 300; font-style: italic;">
                    This is to certify that
                </p>
                
                <h2 class="recipient-name" style="font-family: 'Playfair Display', serif; font-size: 42px; font-weight: 700; color: #333; margin: 20px 0; padding: 15px 0; border-top: 2px solid #e0e0e0; border-bottom: 2px solid #e0e0e0; letter-spacing: 1px;">
                    <?= esc($full_name) ?>
                </h2>
                
                <p style="font-family: 'Open Sans', sans-serif; font-size: 18px; color: #555; margin: 20px 0; font-weight: 300;">
                    has successfully completed the course
                </p>
                
                <h3 class="course-name" style="font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; color: #D4AF37; margin: 20px 0; letter-spacing: 0.5px; text-shadow: 1px 1px 2px rgba(212,175,55,0.15);">
                    <?= esc($course_name) ?>
                </h3>
                
                <div style="margin: 25px 0;">
                    <i class="fas fa-calendar-check" style="color: #D4AF37; margin-right: 10px;"></i>
                    <span style="font-family: 'Open Sans', sans-serif; font-size: 16px; color: #666; font-weight: 400;">
                        Completed on <?= date('F d, Y', strtotime($completed_date)) ?>
                    </span>
                </div>
            </div>

            <!-- Certificate Footer with Signatures -->
            <div class="certificate-footer" style="margin-top: 60px; position: relative; z-index: 1;">
                <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                    <div class="signature-left" style="text-align: center; flex: 1;">
                        <div style="border-top: 2px solid #D4AF37; width: 200px; margin: 0 auto 10px; padding-top: 10px;"></div>
                        <p style="font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: #333; margin: 5px 0;">
                            <i class="fas fa-user-tie" style="color: #D4AF37; margin-right: 8px;"></i>Trainer
                        </p>
                        <p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #666; margin-top: 30px;">
                            Signature
                        </p>
                    </div>
                    
                    <div class="certificate-seal" style="text-align: center; flex: 1;">
                        <div style="width: 140px; height: 140px; border: 5px solid #DC143C; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center; background: radial-gradient(circle, rgba(220,20,60,0.1) 0%, rgba(220,20,60,0.05) 100%); box-shadow: 0 0 20px rgba(220,20,60,0.3), inset 0 0 20px rgba(220,20,60,0.1);">
                            <div style="width: 110px; height: 110px; border: 3px solid #DC143C; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: white;">
                                <i class="fas fa-stamp" style="font-size: 45px; color: #DC143C;"></i>
                            </div>
                        </div>
                        <p style="font-family: 'Playfair Display', serif; font-size: 16px; color: #DC143C; margin-top: 10px; font-weight: 700; text-shadow: 1px 1px 2px rgba(220,20,60,0.2);">
                            StartIT
                        </p>
                        <p style="font-family: 'Open Sans', sans-serif; font-size: 12px; color: #666; margin-top: 5px; font-style: italic;">
                            Official Seal
                        </p>
                    </div>
                    
                    <div class="signature-right" style="text-align: center; flex: 1;">
                        <div style="border-top: 2px solid #D4AF37; width: 200px; margin: 0 auto 10px; padding-top: 10px;"></div>
                        <p style="font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: #333; margin: 5px 0;">
                            <i class="fas fa-certificate" style="color: #D4AF37; margin-right: 8px;"></i>Authorized
                        </p>
                        <p style="font-family: 'Open Sans', sans-serif; font-size: 14px; color: #666; margin-top: 30px;">
                            Date: <?= date('M d, Y', strtotime($completed_date)) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="certificate-actions" style="text-align: center; margin-top: 30px;">
            <button onclick="window.print()" class="print-btn" style="background: linear-gradient(135deg, #D4AF37 0%, #FFD700 100%); color: white; border: none; padding: 15px 40px; font-size: 16px; font-weight: 600; border-radius: 50px; cursor: pointer; box-shadow: 0 10px 30px rgba(212,175,55,0.4); transition: all 0.3s ease; font-family: 'Open Sans', sans-serif;">
                <i class="fas fa-print me-2"></i>Print / Save PDF
            </button>
        </div>
    </div>

    <script>
        // Add hover effect to print button
        document.querySelector('.print-btn').addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 15px 40px rgba(212,175,55,0.5)';
        });
        document.querySelector('.print-btn').addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 10px 30px rgba(212,175,55,0.4)';
        });
    </script>

</body>

</html>