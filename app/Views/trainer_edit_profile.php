<!-- Animated Background Elements -->
<div class="bg-animation">
    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>
    <div class="bg-circle bg-circle-3"></div>
    <div class="bg-circle bg-circle-4"></div>
</div>

<div class="edit-container" style="position: relative; z-index: 1;">
    <div class="edit-card">
        <h1>Edit Profile: <?= esc($trainer['full_name']) ?></h1>

        <form action="<?= base_url('trainer/update_profile') ?>" method="POST" enctype="multipart/form-data">
            <div class="edit-content-wrapper">

                <div class="photo-upload-section">
                    <img src="<?= base_url($trainer['profile_pic'] ?: 'uploads/trainers/default.png') ?>"
                        alt="Profile Preview" class="edit-avatar-preview" id="avatarPreview">

                    <div class="upload-controls">
                        <input type="file" name="profile_pic" id="profile_pic" class="d-none" onchange="previewImage(this)">
                        <label for="profile_pic" class="btn-change-photo">Change Photo</label>
                        <input type="hidden" name="old_pic" value="<?= $trainer['profile_pic'] ?>">
                        <p class="text-muted mt-2" style="font-size: 0.85rem;">Max size: 2MB</p>
                    </div>
                </div>

                <div class="edit-form-section">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" class="form-control" value="<?= esc($trainer['full_name']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" value="<?= esc($trainer['email']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="male" <?= ($trainer['gender'] ?? '') == 'male' ? 'selected' : '' ?>>Male</option>
                            <option value="female" <?= ($trainer['gender'] ?? '') == 'female' ? 'selected' : '' ?>>Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Specialization</label>
                        <input type="text" name="specialization" class="form-control" value="<?= esc($trainer['specialization'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label>Experience (Years)</label>
                        <input type="number" name="experience_years" class="form-control" value="<?= esc($trainer['experience_years'] ?? '0') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New Password (Leave blank to keep current)</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter new password (min 8 characters)">
                        <small class="text-muted">Only fill this if you want to change the password</small>
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" class="form-control" value="Trainer" readonly>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn-save">Save Changes</button>
                        <a href="<?= base_url('trainer/profile') ?>" class="btn-cancel">Cancel</a>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('body').addClass('animated-background');
    });
</script>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>