<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StartIT</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background: #f5f5f5; }
        .header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 20px; }
        .logo { 
            font-size: 24px; 
            font-weight: bold; 
            color: #007bff; }
        .nav { 
            display: flex; 
            gap: 15px; }
        .nav a { 
            text-decoration: none; 
            color: #333; 
            font-weight: bold; }
        .profile { 
            background: #007bff; 
            color: white; 
            padding: 5px 10px; 
            border-radius: 5px; }
        .search-container { 
            margin-bottom: 20px; }
        .search-container input { 
            padding: 10px; 
            width: 300px; 
            border: 1px solid #ddd; 
            border-radius: 5px; }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            background: white; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        th, td { 
            padding: 12px; 
            text-align: left; 
            border-bottom: 1px solid #ddd; }
        th { 
            background: #007bff; 
            color: white; 
            font-weight: bold; }
        .status { 
            padding: 5px 10px; 
            border-radius: 20px; 
            color: white; 
            font-size: 12px; }
        .pending { 
            background: #ffc107; }
        .paid { 
            background: #28a745; }
        .btn { 
            padding: 5px 10px; 
            border: none; 
            border-radius: 3px; 
            cursor: pointer; 
            margin-right: 5px; }
        .btn-edit { 
            background: #007bff; 
            color: white; }
        .btn-delete { 
            background: #dc3545; 
            color: white; }
        @media (max-width: 768px) { .search-container input { width: 100%; } }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">StartIT</div>
        <div class="nav">
            <a href="#">Home</a>
            <a href="#">Configuration</a>
            <a href="#">About</a>
            <div class="profile">👤</div>
        </div>
    </div>

    <?php
    // Database connection (replace with your credentials)
    $pdo = new PDO('mysql:host=localhost;dbname=it_training_db', 'username', 'password');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle search
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $sql = "SELECT id, name, email, gender, course, payment_status FROM trainees";
    if ($search) {
        $sql .= " WHERE name LIKE :search OR email LIKE :search OR course LIKE :search";
    }
    $sql .= " ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    if ($search) {
        $stmt->bindValue(':search', "%$search%");
    }
    $stmt->execute();
    $trainees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="search-container">
        <input type="text" id="search" placeholder="Search by Name, Email or Course" value="<?php echo htmlspecialchars($search); ?>" onkeyup="searchTable()">
    </div>

    <table id="traineesTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Course</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trainees as $trainee): ?>
            <tr>
                <td><?php echo htmlspecialchars($trainee['id']); ?></td>
                <td><?php echo htmlspecialchars($trainee['name']); ?></td>
                <td><?php echo htmlspecialchars($trainee['email']); ?></td>
                <td><?php echo htmlspecialchars($trainee['gender']); ?></td>
                <td><?php echo htmlspecialchars($trainee['course']); ?></td>
                <td>
                    <span class="status <?php echo strtolower($trainee['payment_status']); ?>">
                        <?php echo htmlspecialchars($trainee['payment_status']); ?>
                    </span>
                </td>
                <td>
                    <button class="btn btn-edit">Edit</button>
                    <button class="btn btn-delete">Delete</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function searchTable() {
            const input = document.getElementById('search').value.toLowerCase();
            const table = document.getElementById('traineesTable');
            const rows = table.getElementsByTagName('tr');
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let match = false;
                for (let j = 0; j < cells.length - 1; j++) { // Exclude Actions column
                    if (cells[j].textContent.toLowerCase().includes(input)) {
                        match = true;
                        break;
                    }
                }
                rows[i].style.display = match ? '' : 'none';
            }
        }
    </script>
</body>
</html>