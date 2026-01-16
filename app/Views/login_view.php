<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login | StartIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Main CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body class="login-body">

    <!-- Animated Background Elements -->
    <div class="bg-animation">
        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>
        <div class="bg-circle bg-circle-4"></div>
    </div>

    <!-- =========================
         LOGIN PAGE
    ========================== -->
    <div class="container login-page" style="position: relative; z-index: 1;">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">

                <div class="card login-card">

                    <!-- Title -->
                    <h2 class="login-title text-center"><i class="fas fa-sign-in-alt me-2"></i>Login</h2>

                    <!-- Flash Error Message -->
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger text-center">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <!-- =========================
                         LOGIN FORM
                    ========================== -->
                    <form action="<?= base_url('login-process') ?>" method="post">
                        <?= csrf_field() ?>

                        <!-- Role Selection -->
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-user-tag me-2"></i>Login As:</label>

                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="role"
                                        id="roleTrainee"
                                        value="trainee"
                                        <?= old('role') === 'trainee' ? 'checked' : '' ?>
                                        required>
                                    <label class="form-check-label" for="roleTrainee">
                                        <i class="fas fa-user-graduate me-1"></i>Trainee
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="role"
                                        id="roleTrainer"
                                        value="trainer"
                                        <?= old('role') === 'trainer' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="roleTrainer">
                                        <i class="fas fa-chalkboard-teacher me-1"></i>Trainer
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>Email Address:</label>
                            <div class="position-relative">
                                <i class="fas fa-envelope position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 10;"></i>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    value="<?= old('email') ?>"
                                    placeholder="example@email.com"
                                    style="padding-left: 40px;"
                                    required>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label"><i class="fas fa-lock me-2"></i>Password:</label>
                            <div class="position-relative">
                                <i class="fas fa-lock position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 10;"></i>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    placeholder="Enter your password"
                                    style="padding-left: 40px;"
                                    required>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </div>
                    </form>

                    <!-- Register Link -->
                    <div class="text-center mt-4">
                        <p class="mb-0">
                            Don't have an account?
                            <a href="<?= base_url('register') ?>" class="fw-semibold">
                                <i class="fas fa-user-plus me-1"></i>Register here
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