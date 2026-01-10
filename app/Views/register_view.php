<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register | StartIT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            padding-bottom: 100px;
        }

        fieldset {
            border: 1px solid #dee2e6;
            padding: 15px;
            border-radius: 5px;
        }

        legend {
            width: auto;
            padding: 0 10px;
            font-size: 1.1rem;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow">
                    <div class="card-body p-4">

                        <h2 class="text-center mb-4">Create Your Account</h2>

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

                        <form action="<?= base_url('register-process') ?>" method="post">

                            <?= csrf_field() ?>

                            <!-- Personal Information -->
                            <fieldset>
                                <legend>Personal Information</legend>

                                <!-- Role -->
                                <div class="mb-3">
                                    <label class="form-label">Register As</label><br>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                            type="radio"
                                            name="role"
                                            value="trainee"
                                            <?= old('role') === 'trainee' ? 'checked' : '' ?>
                                            required>
                                        <label class="form-check-label">Trainee</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                            type="radio"
                                            name="role"
                                            value="trainer"
                                            <?= old('role') === 'trainer' ? 'checked' : '' ?>>
                                        <label class="form-check-label">Trainer</label>
                                    </div>
                                </div>

                                <!-- Full Name -->
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text"
                                        name="full_name"
                                        class="form-control"
                                        value="<?= old('full_name') ?>"
                                        required>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email"
                                        name="email"
                                        class="form-control"
                                        value="<?= old('email') ?>"
                                        required>
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password"
                                        name="password"
                                        class="form-control"
                                        required>
                                </div>
                            </fieldset>

                            <!-- Additional Details -->
                            <fieldset class="mt-4">
                                <legend>Additional Details</legend>

                                <!-- Phone (Trainee only, optional) -->
                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text"
                                        name="phone_num"
                                        class="form-control"
                                        value="<?= old('phone_num') ?>">
                                </div>

                                <!-- Gender -->
                                <div class="mb-3">
                                    <label class="form-label">Gender</label><br>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                            type="radio"
                                            name="gender"
                                            value="male"
                                            <?= old('gender') === 'male' ? 'checked' : '' ?>>
                                        <label class="form-check-label">Male</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                            type="radio"
                                            name="gender"
                                            value="female"
                                            <?= old('gender') === 'female' ? 'checked' : '' ?>>
                                        <label class="form-check-label">Female</label>
                                    </div>
                                </div>

                            </fieldset>

                            <!-- Submit -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Register
                                </button>
                            </div>

                        </form>

                        <div class="text-center mt-3">
                            <p class="mb-0">
                                Already have an account?
                                <a href="<?= base_url('login') ?>">Login here</a>
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>