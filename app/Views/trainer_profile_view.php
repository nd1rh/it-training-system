<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MyProfile - Trainer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f4f7f6; }
        
        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }

        .profile-header h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        .avatar-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 15px;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            background-color: #d9d9d9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: #555;
        }

        .edit-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background-color: #0d6efd;
            color: white;
            border-radius: 50%;
            padding: 5px;
            font-size: 0.8rem;
            border: 2px solid white;
        }

        .trainer-name {
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 30px;
        }

        .details-box {
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            padding: 30px;
            text-align: left;
            border-radius: 4px;
        }

        .details-box h4 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .detail-item {
            font-size: 1.1rem;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .detail-value {
            font-weight: normal;
            margin-left: 5px;
        }
    </style>
</head>

<body>

    <div class="profile-container">
        <div class="profile-header">
            <h1>MyProfile</h1>
        </div>

    <div class="avatar-wrapper">
        <div class="profile-avatar">
            <i class="bi bi-person-fill"></i>
        </div>
        <div class="edit-icon">
            <i class="bi bi-pencil-fill"></i>
        </div>
    </div>

        <div class="trainer-name">
            <?= esc($trainer['full_name']) ?>
        </div>

        <div class="details-box">
            <h4>Details:</h4>

            <div class="detail-item">
                Full Name: <span class="detail-value"><?= esc($trainer['full_name']) ?></span>
            </div>

            <div class="detail-item">
                Email Address: <span class="detail-value"><?= esc($trainer['email']) ?></span>
            </div>

            <div class="detail-item">
                Specialization: <span class="detail-value"><?= esc($trainer['specialization'] ?? 'N/A') ?></span>
            </div>

            <div class="detail-item">
                Experience: <span class="detail-value"><?= esc($trainer['experience_years'] ?? '0') ?> Years</span>
            </div>

            <div class="detail-item">
                Role: <span class="detail-value text-capitalize"><?= esc(session()->get('role')) ?></span>
            </div>
        </div>
    </div>

</body>

</html>