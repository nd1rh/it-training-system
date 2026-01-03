<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Login</h2>

                    <!-- Display Error Flashdata (e.g. Invalid password) -->
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    <!-- Login Form -->
                    <!-- The action points to the route we defined: /login-process -->
                    <form action="<?= base_url('/login-process') ?>"
                        method="post">

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                        </div>

                    </form>
                    <div class="text-center mt-3">
                        <p>Don't have an account? <a href="<?=base_url('/register') ?>">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>