<!-- Animated Background Elements -->
<div class="bg-animation">
    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>
    <div class="bg-circle bg-circle-3"></div>
    <div class="bg-circle bg-circle-4"></div>
</div>

<div class="profile-container" style="position: relative; z-index: 1;">
    <div class="profile-card">
        <h1 class="profile-title">My Profile</h1>

        <form action="<?= base_url('trainee/update_photo') ?>" method="POST" enctype="multipart/form-data" id="profilePicForm">
            <?= csrf_field() ?>
            <div class="profile-avatar-container">
                <img 
                    id="profilePreview" 
                    src="<?= base_url($trainee['profile_pic'] ?: 'assets/images/default-avatar.png') ?>" 
                    class="profile-avatar" 
                    alt="User Avatar">
                
                <label for="imageUpload" class="edit-icon-badge" style="cursor: pointer;">
                    ✎
                </label>
                <input type="file" name="profile_pic" id="imageUpload" accept="image/*" style="display: none;">
            </div>
        </form>

        <h1 class="user-display-name"><?= esc($trainee['full_name']) ?></h1>
        <span class="user-role-badge">Student / Trainee</span>

        <div class="details-box">
            <div class="info-item">
                <span class="info-label">Full Name</span>
                <span class="info-value"><?= esc($trainee['full_name']) ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Email Address</span>
                <span class="info-value"><?= esc($trainee['email']) ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Phone Number</span>
                <span class="info-value"><?= esc($trainee['phone_num'] ?? 'Not Provided') ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Date of Birth</span>
                <span class="info-value"><?= esc($trainee['date_of_birth'] ?? 'Not set') ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Gender</span>
                <span class="info-value"><?= ucfirst(esc($trainee['gender'] ?? 'Not set')) ?></span>
            </div>
        </div>

        <div class="profile-actions">
            <a href="<?= base_url('trainee/edit_profile') ?>" class="btn-edit-profile">
                Edit Profile
            </a>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('body').addClass('animated-background');
    });
</script>

<script>
    // Live Image Preview & Auto-Submit Logic
    const imageUpload = document.getElementById('imageUpload');
    const profilePreview = document.getElementById('profilePreview');
    const profilePicForm = document.getElementById('profilePicForm');

    imageUpload.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (!file) return;

        // Size validation (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert("File too large! Maximum 2MB.");
            this.value = "";
            return;
        }

        // Preview before the page reloads
        const reader = new FileReader();
        reader.onload = function(e) {
            profilePreview.src = e.target.result;
        }
        reader.readAsDataURL(file);

        // Auto-submit the form to the controller
        profilePicForm.submit();
    });
</script>