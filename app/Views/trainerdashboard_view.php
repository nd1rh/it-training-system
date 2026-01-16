<!-- Animated Background Elements -->
<div class="bg-animation">
    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>
    <div class="bg-circle bg-circle-3"></div>
    <div class="bg-circle bg-circle-4"></div>
</div>

<div class="container mt-5 text-center" style="position: relative; z-index: 1;">
   
    <div class="dashboard-container mt-5">
        <h1 class="welcome-header"> Welcome, <?= esc(session()->get('full_name')) ?>!
        </h1>

        <div class="action-grid"> <a href="<?= base_url('configure/trainee') ?>" class="btn-action-card bg-manage-trainees">
                Manage Trainees
            </a>

            <a href="<?= base_url('configure/course') ?>" class="btn-action-card bg-manage-courses">
                Manage Courses
            </a>

            <a href="<?= base_url('trainer/profile') ?>" class="btn-action-card bg-my-profile">
                My Profile
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