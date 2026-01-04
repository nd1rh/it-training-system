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
                    <form action="<?= base_url('/register-process') ?>"
                        method="post">

                        <!-- Personal Info -->
                        <fieldset>
                            <legend>Personal Information</legend>
                            <div class="mb-3">
                                <label>First Name</label>
                                <input type="text" name="first_name"
                                    class="form-control" value="<?= old('first_name') ?>">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?= old('email') ?>">
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password"
                                    class="form-control">
                            </div>
                        </fieldset>
                        <!-- Additional Details -->
                        <fieldset class="mt-4">
                            <legend>Additional Details</legend>
                            <div class="mb-3">
                                <label>Birth Date</label>
                                <input type="date" name="birth_date"
                                    class="form-control" value="<?= old('birth_date') ?>">
                            </div>
                            <div class="mb-3">
                                <label>Gender</label><br>
                                <input type="radio" name="gender"
                                    value="male"> Male
                                <input type="radio" name="gender"
                                    value="female" class="ms-3"> Female
                            </div>
                            <div class="mb-3">
                                <label>Year of Study</label>
                                <select name="year_of_study" class="formselect">
                                    <option value="">Select Year</option>
                                    <option value="1">Year 1</option>
                                    <option value="2">Year 2</option>
                                    <option value="3">Year 3</option>
                                    <option value="4">Year 4</option>
                                    <option value="5">Year 5</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Profile Theme Color</label>
                                <input type="color" name="theme_color"
                                    class="form-control form-control-color" value="#3498db">
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