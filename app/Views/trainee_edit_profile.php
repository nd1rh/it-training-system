<!-- Animated Background Elements -->
<div class="bg-animation">
    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>
    <div class="bg-circle bg-circle-3"></div>
    <div class="bg-circle bg-circle-4"></div>
</div>

<div class="edit-container" style="position: relative; z-index: 1;">
    <div class="edit-card">
        <h1>Edit Profile: <?= esc($trainee['full_name']) ?></h1>

        <form action="<?= base_url('trainee/update_profile') ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="old_pic" value="<?= $trainee['profile_pic'] ?>">

            <div class="edit-content-wrapper">

                <!-- Profile Photo -->
                <div class="photo-upload-section">
                    <img src="<?= base_url($trainee['profile_pic'] ?: 'uploads/trainees/default.png') ?>"
                        alt="Profile Preview"
                        class="edit-avatar-preview"
                        id="avatarPreview">

                    <div class="upload-controls">
                        <input type="file"
                            name="profile_pic"
                            id="profile_pic"
                            class="d-none"
                            accept="image/*"
                            onchange="previewImage(this)">
                        <label for="profile_pic" class="btn-change-photo">Change Photo</label>
                        <p class="text-muted mt-2" style="font-size: 0.85rem;">
                            Max size: 2MB
                        </p>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="edit-form-section">

                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text"
                            name="full_name"
                            class="form-control"
                            value="<?= esc($trainee['full_name']) ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email"
                            name="email"
                            class="form-control"
                            value="<?= esc($trainee['email']) ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text"
                            name="phone_number"
                            class="form-control"
                            value="<?= esc($trainee['phone_num'] ?? '') ?>"
                            placeholder="012-3456789">
                    </div>

                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date"
                            name="dob"
                            class="form-control"
                            value="<?= esc($trainee['date_of_birth'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="male" <?= ($trainee['gender'] ?? '') == 'male' ? 'selected' : '' ?>>Male</option>
                            <option value="female" <?= ($trainee['gender'] ?? '') == 'female' ? 'selected' : '' ?>>Female</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New Password (Leave blank to keep current)</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter new password (min 8 characters)">
                        <small class="text-muted">Only fill this if you want to change the password</small>
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <input type="text"
                            class="form-control"
                            value="Trainee"
                            readonly>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn-save">Save Changes</button>
                        <a href="<?= base_url('trainee/profile') ?>" class="btn-cancel">Cancel</a>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('body').addClass('animated-background');
    });

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];

            if (file.size > 2 * 1024 * 1024) {
                alert("File is too large! Please select an image under 2MB.");
                input.value = "";
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>