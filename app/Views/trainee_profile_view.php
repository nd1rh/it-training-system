<style>
    .profile-body {
        background-color: #ffffff;
        min-height: 80vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 40px;
    }

    .profile-title {
        font-size: 2.2rem;
        margin-bottom: 20px;
        color: #333;
    }

    .avatar-container {
        position: relative;
        margin-bottom: 15px;
    }

    .avatar-circle {
        width: 120px;
        height: 120px;
        background-color: #ccc;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .avatar-circle i {
        font-size: 80px;
        color: #666;
    }

    .avatar-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .edit-btn {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: #0d6efd;
        color: white;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        border: 2px solid white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .trainee-name-display {
        font-size: 1.4rem;
        font-weight: 500;
        margin-bottom: 25px;
    }

    .details-card {
        background-color: #e9ecef;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        width: 100%;
        max-width: 500px;
        padding: 25px;
        text-align: left;
    }

    .details-card h4 {
        font-weight: bold;
        margin-bottom: 15px;
    }

    .info-row {
        margin-bottom: 10px;
        font-size: 1.05rem;
    }

    .info-label {
        font-weight: bold;
    }
</style>

<div class="profile-body">
    <h1 class="profile-title">MyProfile</h1>

    <div class="avatar-circle">
        <img
            src="<?= base_url($trainee['profile_pic'] ?: 'uploads/trainees/default.png') ?>"
            alt="Profile">
    </div>

    <div class="trainee-name-display"><?= esc($trainee['full_name']) ?></div>

    <div class="details-card">
        <h4>Details:</h4>
        <div class="info-row"><span class="info-label">Full Name:</span> <?= esc($trainee['full_name']) ?></div>
        <div class="info-row"><span class="info-label">Email Address:</span> <?= esc($trainee['email']) ?></div>
        <div class="info-row"><span class="info-label">Phone Number:</span> <?= esc($trainee['phone_num'] ?? 'Not provided') ?></div>
        <div class="info-row"><span class="info-label">Date of Birth:</span> <?= esc($trainee['date_of_birth'] ?? 'Not set') ?></div>
        <div class="info-row"><span class="info-label">Role:</span> Trainee</div>
    </div>
</div>