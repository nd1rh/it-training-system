<div class="bg-animation">
    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>
    <div class="bg-circle bg-circle-3"></div>
    <div class="bg-circle bg-circle-4"></div>
</div>

<div class="payment-page-wrapper">
    <div class="container payment-page">

        <section class="payment-header text-center fade-in-up" style="animation-delay: 0.1s;">
            <h2 class="page-title">Course Payment</h2>
        </section>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger text-center fade-in-up">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success text-center fade-in-up">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if ($course): ?>

            <div class="payment-content-wrapper">

                <div class="payment-summary-card fade-in-up" style="animation-delay: 0.3s;">
                    <h3 class="payment-course-title"><?= esc($course['course_name']) ?></h3>

                    <p class="payment-course-desc">
                        <?= esc($course['course_desc']) ?>
                    </p>

                    <div class="payment-info-grid">
                        <div class="payment-info-item">
                            <span class="payment-info-label">Duration</span>
                            <span class="payment-info-value">
                                <?= esc($course['course_duration']) ?> hours
                            </span>
                        </div>

                        <div class="payment-info-item payment-amount-highlight">
                            <span class="payment-info-label">Amount to Pay</span>
                            <span class="payment-info-value payment-amount">
                                RM <?= number_format($course['price'], 2) ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="payment-form-card fade-in-up" style="animation-delay: 0.4s;">
                    <h4 class="payment-form-title">Payment Details</h4>

                    <form method="post"
                        action="<?= site_url('payment/process') ?>"
                        id="paymentForm">

                        <?= csrf_field() ?>

                        <input type="hidden" name="course_id" value="<?= $course['course_id'] ?>">
                        <input type="hidden" name="amount" value="<?= $course['price'] ?>">

                        <div class="form-group-payment">
                            <label for="payment_method">Payment Method</label>
                            <select name="payment_method"
                                id="payment_method"
                                class="form-select-payment"
                                required>
                                <option value="Internet Banking">Internet Banking</option>
                                <option value="DuitNow">DuitNow</option>
                                <option value="Touch n Go Ewallet">Touch n Go E-Wallet</option>
                            </select>
                        </div>

                        <div class="payment-actions">
                            <button type="submit" class="btn-pay-now">
                                Pay Now
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="<?= site_url('courses/detail/' . $course['course_id']) ?>"
                    class="btn-back-course">
                    Back to Course
                </a>
            </div>

        <?php else: ?>
            <div class="alert alert-warning text-center">
                Course not found.
            </div>
        <?php endif; ?>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {

        $('body').addClass('animated-background');

        $('#paymentForm').on('submit', function(e) {

            const paymentMethod = $('#payment_method').val();
            const amount = 'RM <?= number_format($course['price'], 2) ?>';

            const confirmPayment = confirm(
                "Confirm Payment\n\n" +
                "Payment Method: " + paymentMethod + "\n" +
                "Amount: " + amount + "\n\n" +
                "Are you sure you want to proceed?"
            );

            if (!confirmPayment) {
                e.preventDefault();
            }
        });

    });
</script>