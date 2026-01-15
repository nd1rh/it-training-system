<!-- Animated Background Elements -->
<div class="bg-animation">
    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>
    <div class="bg-circle bg-circle-3"></div>
    <div class="bg-circle bg-circle-4"></div>
</div>

<div class="edit-container" style="position: relative; z-index: 1;"> <div class="edit-card"> <h1>Edit Profile: <?= esc($trainee['full_name']) ?></h1>

        <form action="<?= base_url('trainee/update_profile') ?>" method="POST" enctype="multipart/form-data" id="editProfileForm">
            <?= csrf_field() ?>
            <input type="hidden" name="old_pic" value="<?= $trainee['profile_pic'] ?>">

            <div class="edit-content-wrapper"> <div class="photo-upload-section">
                    <img id="imagePreview" 
                         class="edit-avatar-preview" 
                         src="<?= base_url($trainee['profile_pic'] ?: 'assets/images/default-avatar.png') ?>" 
                         alt="Profile Preview">
                    
                    <div class="upload-actions">
                        <label for="profile_pic" class="btn-change-photo">Change Photo</label>
                        <input type="file" name="profile_pic" id="profile_pic" accept="image/*" style="display: none;">
                        <br>
                        <small class="text-muted">Recommended: Square JPG/PNG</small>
                    </div>
                </div>

                <div class="edit-form-section">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" class="form-control" value="<?= esc($trainee['full_name']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" value="<?= esc($trainee['email']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" value="<?= esc($trainee['phone_num'] ?? '') ?>" placeholder="012-3456789">
                    </div>

                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" class="form-control" value="<?= esc($trainee['date_of_birth'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" class="form-control" value="Student / Trainee" readonly>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn-save">Save Changes</button>
                        <a href="<?= base_url('trainee/profile') ?>" class="btn-cancel">Cancel and Go Back</a>
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
    // Live Image Preview Logic
    document.getElementById('profile_pic').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                alert("File is too large! Please select an image under 2MB.");
                this.value = "";
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>