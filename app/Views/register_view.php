<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register | StartIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Main CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body class="register-body">

    <!-- Animated Background Elements -->
    <div class="bg-animation">
        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>
        <div class="bg-circle bg-circle-4"></div>
    </div>

    <!-- =========================
         REGISTER PAGE
    ========================== -->
    <div class="container register-page" style="position: relative; z-index: 1;">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">

                <div class="card register-card">

                    <!-- Title -->
                    <h2 class="register-title text-center"><i class="fas fa-user-plus me-2"></i>Create Your Account</h2>

                    <!-- Validation Errors -->
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- =========================
                         REGISTER FORM
                    ========================== -->
                    <form action="<?= base_url('register-process') ?>" method="post">
                        <?= csrf_field() ?>

                        <!-- =========================
                             PERSONAL INFORMATION
                        ========================== -->
                        <fieldset class="register-fieldset">
                            <legend>Personal Information</legend>

                            <!-- Full Name -->
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-user me-2"></i>Full Name</label>
                                <div class="position-relative">
                                    <i class="fas fa-user position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 10;"></i>
                                    <input
                                        type="text"
                                        name="full_name"
                                        class="form-control"
                                        value="<?= old('full_name') ?>"
                                        style="padding-left: 40px;"
                                        required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-envelope me-2"></i>Email Address</label>
                                <div class="position-relative">
                                    <i class="fas fa-envelope position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 10;"></i>
                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        value="<?= old('email') ?>"
                                        style="padding-left: 40px;"
                                        required>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-lock me-2"></i>Password</label>
                                <div class="position-relative">
                                    <i class="fas fa-lock position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 10;"></i>
                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control"
                                        style="padding-left: 40px;"
                                        required>
                                </div>
                            </div>
                        </fieldset>

                        <!-- =========================
                             ADDITIONAL DETAILS
                        ========================== -->
                        <fieldset class="register-fieldset mt-4">
                            <legend>Additional Details</legend>

                            <!-- Phone -->
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-phone me-2"></i>Phone Number</label>
                                <div class="position-relative">
                                    <i class="fas fa-phone position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 10;"></i>
                                    <input
                                        type="text"
                                        name="phone_num"
                                        class="form-control"
                                        value="<?= old('phone_num') ?>"
                                        style="padding-left: 40px;">
                                </div>
                            </div>

                            <!-- Gender -->
                            <div class="mb-3">
                                <label class="form-label">Gender</label>

                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="gender"
                                            value="male"
                                            <?= old('gender') === 'male' ? 'checked' : '' ?>>
                                        <label class="form-check-label">Male</label>
                                    </div>

                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="gender"
                                            value="female"
                                            <?= old('gender') === 'female' ? 'checked' : '' ?>>
                                        <label class="form-check-label">Female</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Date of Birth -->
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-calendar me-2"></i>Date of Birth</label>
                                <div class="position-relative">
                                    <i class="fas fa-calendar position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 10;"></i>
                                    <input
                                        type="date"
                                        name="date_of_birth"
                                        class="form-control"
                                        value="<?= old('date_of_birth') ?>"
                                        style="padding-left: 40px;">
                                </div>
                            </div>

                        </fieldset>

                        <!-- Submit -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Register
                            </button>
                        </div>

                    </form>

                    <!-- Login Link -->
                    <div class="text-center mt-3">
                        <p class="mb-0">
                            Already have an account?
                            <a href="<?= base_url('login') ?>" class="fw-semibold">
                                <i class="fas fa-sign-in-alt me-1"></i>Login here
                            </a>
                        </p>
                    </div>

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