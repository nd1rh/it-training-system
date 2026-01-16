<!-- Animated Background Elements -->
<div class="bg-animation">
    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>
    <div class="bg-circle bg-circle-3"></div>
    <div class="bg-circle bg-circle-4"></div>
</div>

<div class="container mt-5 pt-5 mb-5" style="position: relative; z-index: 1;">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm border-0 profile-card text-center p-4"
                style="background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px);">

                <div class="card-body">
                    <h2 class="text-primary fw-bold mb-4">My Profile</h2>

                    <!-- Profile Picture -->
                    <form action="<?= base_url('trainee/update_photo') ?>"
                        method="POST"
                        enctype="multipart/form-data"
                        id="profilePicForm">
                        <?= csrf_field() ?>

                        <div class="profile-avatar-container">
                            <img
                                id="profilePreview"
                                src="<?= base_url($trainee['profile_pic'] ?: 'uploads/trainees/default.png') ?>"
                                class="profile-avatar"
                                alt="User Avatar">

                            <label for="imageUpload" class="edit-icon-badge" style="cursor: pointer;">
                                ✎
                            </label>
                            <input type="file"
                                name="profile_pic"
                                id="imageUpload"
                                accept="image/*"
                                style="display: none;">
                        </div>
                    </form>

                    <!-- Name & Role -->
                    <h1 class="fw-bold text-primary mb-1"><?= esc($trainee['full_name']) ?></h1>
                    <p class="badge bg-light text-muted px-3 py-2 rounded-pill">
                        Trainee
                    </p>

                    <!-- Details -->
                    <div class="mt-5 text-start">
                        <div class="list-group list-group-flush border-top">

                            <div class="list-group-item d-flex py-3 bg-transparent border-bottom">
                                <span class="fw-bold w-40 text-dark">Full Name</span>
                                <span class="text-muted"><?= esc($trainee['full_name']) ?></span>
                            </div>

                            <div class="list-group-item d-flex py-3 bg-transparent border-bottom">
                                <span class="fw-bold w-40 text-dark">Email Address</span>
                                <span class="text-muted"><?= esc($trainee['email']) ?></span>
                            </div>

                            <div class="list-group-item d-flex py-3 bg-transparent border-bottom">
                                <span class="fw-bold w-40 text-dark">Phone Number</span>
                                <span class="text-muted">
                                    <?= esc($trainee['phone_num'] ?? 'Not Provided') ?>
                                </span>
                            </div>

                            <div class="list-group-item d-flex py-3 bg-transparent border-bottom">
                                <span class="fw-bold w-40 text-dark">Date of Birth</span>
                                <span class="text-muted">
                                    <?= esc($trainee['date_of_birth'] ?? 'Not set') ?>
                                </span>
                            </div>

                            <div class="list-group-item d-flex py-3 bg-transparent border-bottom">
                                <span class="fw-bold w-40 text-dark">Gender</span>
                                <span class="text-muted">
                                    <?= ucfirst(esc($trainee['gender'] ?? 'Not set')) ?>
                                </span>
                            </div>

                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-5">
                        <a href="<?= base_url('trainee/edit_profile') ?>"
                            class="btn btn-primary px-5 py-2 fw-bold">
                            Edit Profile
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('body').addClass('animated-background');
    });

    // Auto upload + preview
    const imageUpload = document.getElementById('imageUpload');
    const profilePreview = document.getElementById('profilePreview');
    const profilePicForm = document.getElementById('profilePicForm');

    imageUpload.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;

        if (file.size > 2 * 1024 * 1024) {
            alert("File too large! Maximum 2MB.");
            this.value = "";
            return;
        }

        const reader = new FileReader();
        reader.onload = e => profilePreview.src = e.target.result;
        reader.readAsDataURL(file);

        profilePicForm.submit();
    });
</script>