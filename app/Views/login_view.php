<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login | StartIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body class="login-body">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card login-card">

                    <h2 class="login-title">Login</h2>

                    <!-- Flash Error Message -->
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger text-center">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Login Form -->
                    <form action="<?= base_url('login-process') ?>" method="post">
                        <?= csrf_field() ?>

                        <!-- Role Selection -->
                        <div class="mb-3">
                            <label class="form-label">Login As</label><br>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input"
                                    type="radio"
                                    name="role"
                                    id="roleTrainee"
                                    value="trainee"
                                    <?= old('role') === 'trainee' ? 'checked' : '' ?>
                                    required>
                                <label class="form-check-label" for="roleTrainee">
                                    Trainee
                                </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input"
                                    type="radio"
                                    name="role"
                                    id="roleTrainer"
                                    value="trainer"
                                    <?= old('role') === 'trainer' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="roleTrainer">
                                    Trainer
                                </label>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                value="<?= old('email') ?>"
                                required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                required>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Login
                            </button>
                        </div>

                    </form>

                    <div class="text-center mt-3">
                        <p class="mb-0">
                            Don’t have an account?
                            <a href="<?= base_url('register') ?>">Register here</a>
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </div>

</body>

</html>