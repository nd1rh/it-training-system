<!-- Animated Background Elements -->
<div class="bg-animation">
    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>
    <div class="bg-circle bg-circle-3"></div>
    <div class="bg-circle bg-circle-4"></div>
</div>

<div class="container mt-5 pt-5 mb-5" style="position: relative; z-index: 1; padding-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm border-0 profile-card text-center p-4" style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px);">
                <div class="card-body">
                    <h2 class="text-primary fw-bold mb-4">My Profile</h2>

                    <div class="position-relative d-inline-block mb-4">
                        <img src="<?= base_url($trainer['profile_pic'] ?: 'assets/images/default-avatar.png') ?>" 
                             alt="User Avatar" class="rounded-circle border profile-avatar-large">
                        <a href="<?= base_url('trainer/edit_profile') ?>" class="btn btn-primary btn-sm rounded-circle position-absolute bottom-0 start-100 translate-middle shadow-sm">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                    </div>

                    <h1 class="fw-bold text-primary mb-1"><?= $trainer['full_name'] ?></h1>
                    <p class="badge bg-light text-muted px-3 py-2 rounded-pill">Trainer</p>

                    <div class="mt-5 text-start">
                        <div class="list-group list-group-flush border-top">
                            <div class="list-group-item d-flex py-3 bg-transparent border-bottom">
                                <span class="fw-bold w-40 text-dark">Full Name</span>
                                <span class="text-muted"><?= $trainer['full_name'] ?></span>
                            </div>
                            <div class="list-group-item d-flex py-3 bg-transparent border-bottom">
                                <span class="fw-bold w-40 text-dark">Email Address</span>
                                <span class="text-muted"><?= $trainer['email'] ?></span>
                            </div>
                            <div class="list-group-item d-flex py-3 bg-transparent border-bottom">
                                <span class="fw-bold w-40 text-dark">Gender</span>
                                <span class="text-muted"><?= ucfirst($trainer['gender']) ?></span>
                            </div>
                            <div class="list-group-item d-flex py-3 bg-transparent border-bottom">
                                <span class="fw-bold w-40 text-dark">Specialization</span>
                                <span class="text-muted"><?= $trainer['specialization'] ?></span>
                            </div>
                            <div class="list-group-item d-flex py-3 bg-transparent border-bottom">
                                <span class="fw-bold w-40 text-dark">Experience</span>
                                <span class="text-muted"><?= $trainer['experience_years'] ?> Years</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <a href="<?= base_url('trainer/edit_profile') ?>" class="btn btn-primary px-5 py-2 fw-bold">Edit Profile</a>
                    </div>
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