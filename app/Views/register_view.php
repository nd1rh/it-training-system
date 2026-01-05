<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Create Your Account</h2>

                    <!-- Display Validation Errors from Controller -->
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach (
                                    session()->getFlashdata('errors') as
                                    $error
                                ): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form action="<?= base_url('/register-process') ?>" method="post" enctype="multipart/form-data">

                        <!-- Personal Info -->
                        <fieldset>
                            <legend>Personal Information</legend>

                            <div class="mb-3">
                                <label>Profile Image</label>
                                <input type="file" name="profile_image" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Full Name</label>
                                <input type="text" name="full_name" class="form-control" value="<?= old('full_name') ?>">
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?= old('email') ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            
                        </fieldset>

                        <!-- Additional Details -->
                        <fieldset class="mt-4">
                            <legend>Additional Details</legend>
                            <div class="mb-3">
                                <label>Phone Number</label>
                                <input type="text" name="phone_num" class="form-control" value="<?= old('phone_num') ?>">
                            </div>
                            <div class="mb-3">
                                <label>Gender</label><br>
                                <input type="radio" name="gender" value="male"> Male
                                <input type="radio" name="gender" value="female" class="ms-3"> Female
                            </div>
                        </fieldset>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><br /><br />