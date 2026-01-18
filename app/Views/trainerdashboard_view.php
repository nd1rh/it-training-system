<div class="bg-animation">
    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>
    <div class="bg-circle bg-circle-3"></div>
    <div class="bg-circle bg-circle-4"></div>
</div>

<div class="container mt-5" style="position: relative; z-index: 1;">

    <div class="dashboard-container mt-5 text-center">
        <h1 class="welcome-header">
            Welcome, <?= esc(session()->get('full_name')) ?>!
        </h1>

        <?php if (!empty($totalEarnings)): ?>
            <div class="card shadow-sm mt-4 mb-4 p-3">
                <h5>Total Earnings:</h5>
                <h3 class="text-success">RM <?= number_format($totalEarnings, 2) ?></h3>
            </div>
        <?php endif; ?>

        <?php if (!empty($courseNames)): ?>
            <div class="card shadow-sm mt-3 mb-5">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-chart-bar me-2"></i>Revenue per Course (RM)
                    </h5>
                    <canvas id="trainerRevenueChart" height="120"></canvas>
                </div>
            </div>
        <?php else: ?>
            <p class="text-muted mt-4">No revenue data available yet.</p>
        <?php endif; ?>

        <div class="action-grid mt-4">
            <a href="<?= base_url('configure/trainee') ?>" class="btn-action-card bg-manage-trainees">
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        $('body').addClass('animated-background');

        <?php if (!empty($courseNames)): ?>
            const ctx = document.getElementById('trainerRevenueChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($courseNames) ?>,
                    datasets: [{
                        label: 'Revenue (RM)',
                        data: <?= json_encode($courseRevenue) ?>,
                        backgroundColor: 'rgba(40, 167, 69, 0.7)',
                        borderColor: 'rgba(40, 167, 69, 1)',
                        borderWidth: 1,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: value => 'RM ' + value
                            }
                        }
                    }
                }
            });
        <?php endif; ?>
    });
</script>