<!-- Animated Background Elements -->
<div class="bg-animation">
    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>
    <div class="bg-circle bg-circle-3"></div>
    <div class="bg-circle bg-circle-4"></div>
</div>

<div class="payment-page-wrapper">
    <div class="container payment-page">
        <!-- =========================
             PAGE TITLE
        ========================== -->
        <section class="payment-header text-center fade-in-up" style="animation-delay: 0.1s;">
            <h2 class="page-title">Course Payment</h2>
        </section>

        <!-- =========================
             FLASH MESSAGES
        ========================== -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger text-center fade-in-up" style="animation-delay: 0.2s;">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success text-center fade-in-up" style="animation-delay: 0.2s;">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if ($course): ?>

            <div class="payment-content-wrapper">
                <!-- =========================
                     COURSE SUMMARY
                ========================== -->
                <div class="payment-summary-card fade-in-up" style="animation-delay: 0.3s;">
                    <div class="payment-summary-header">
                        <h3 class="payment-course-title"><?= esc($course['course_name']) ?></h3>
                    </div>

                    <p class="payment-course-desc">
                        <?= esc($course['course_desc']) ?>
                    </p>

                    <div class="payment-info-grid">
                        <div class="payment-info-item">
                            <span class="payment-info-label"><i class="fas fa-clock me-2"></i>Duration</span>
                            <span class="payment-info-value"><?= esc($course['course_duration']) ?> hours</span>
                        </div>
                        
                        <div class="payment-info-item payment-amount-highlight">
                            <span class="payment-info-label"><i class="fas fa-money-bill-wave me-2"></i>Amount to Pay</span>
                            <span class="payment-info-value payment-amount">RM <?= number_format($course['price'], 2) ?></span>
                        </div>
                    </div>
                </div>

                <!-- =========================
                     PAYMENT FORM
                ========================== -->
                <div class="payment-form-card fade-in-up" style="animation-delay: 0.4s;">
                    <h4 class="payment-form-title"><i class="fas fa-credit-card me-2"></i>Payment Details</h4>
                    
                    <form method="post" action="<?= site_url('payment/process') ?>" class="payment-form">
                        <?= csrf_field() ?>

                        <input type="hidden" name="course_id" value="<?= $course['course_id'] ?>">
                        <input type="hidden" name="amount" value="<?= $course['price'] ?>">

                        <div class="form-group-payment">
                            <label for="payment_method" class="form-label-payment">
                                <i class="fas fa-wallet me-2"></i>Select Payment Method
                            </label>

                            <select
                                name="payment_method"
                                id="payment_method"
                                class="form-select-payment"
                                required>
                                <option value="Internet Banking"><i class="fas fa-university"></i> Internet Banking</option>
                                <option value="DuitNow">DuitNow</option>
                                <option value="Touch n Go Ewallet">Touch n Go E-Wallet</option>
                            </select>
                        </div>

                        <div class="payment-actions">
                            <button type="submit" class="btn-pay-now">
                                <i class="fas fa-credit-card me-2"></i><span>Pay Now</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center mt-4 fade-in-up" style="animation-delay: 0.5s;">
                <a
                    href="<?= site_url('courses/detail/' . $course['course_id']) ?>"
                    class="btn-back-course">
                    <i class="fas fa-arrow-left me-2"></i>Back to Course
                </a>
            </div>

        <?php else: ?>
            <div class="alert alert-warning text-center fade-in-up">
                Course not found.
            </div>
        <?php endif; ?>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Add animated background class to body
        $('body').addClass('animated-background');
        
        // Trigger animations on page load
        $('.fade-in-up').each(function(index) {
            $(this).css('opacity', '1');
        });
    });
</script>