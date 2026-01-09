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
            margin-bottom: 20px; 
            background: white;
            padding: 15px 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .logo { 
            font-size: 24px; 
            font-weight: bold; 
            color: #333; }
        .nav { 
            display: flex; 
            gap: 20px; 
            align-items: center; }
        .nav a { 
            text-decoration: none; 
            color: #333; 
            font-weight: normal; }
        
        /* --- Dropdown Styles --- */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropbtn {
            cursor: pointer;
            border: none;
            background: none;
            font-size: 16px;
            font-weight: normal;
            color: #333;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 150px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 4px;
            right: 0; /* Aligns dropdown to the right */
            border: 1px solid #ddd;
        }

        .dropdown-content a {
            color: #333;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            font-size: 14px;
            border-bottom: 1px solid #f1f1f1;
        }

        .dropdown-content a:last-child { border-bottom: none; }

        .dropdown-content a:hover { background-color: #f8f9fa; color: #007bff; }

        .dropdown:hover .dropdown-content { display: block; }
        /* ------------------------ */

        .profile { 
            background: #eee; 
            color: #555; 
            padding: 5px 10px; 
            border-radius: 50%; }

        /* Table and Search Styles preserved from your original code */
        .search-container { margin-bottom: 20px; }
        .search-container input { padding: 10px; width: 300px; border: 1px solid #ddd; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #007bff; color: white; }
        .status { padding: 5px 10px; border-radius: 20px; color: white; font-size: 12px; }
        .pending { background: #ffc107; }
        .paid { background: #28a745; }
        .btn { padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer; margin-right: 5px; }
        .btn-edit { background: #007bff; color: white; }
        .btn-delete { background: #dc3545; color: white; }
    </style>
</head>
<body>

    <div class="header">
        <div class="logo">StartIT</div>
        <div class="nav">
            <a href="dashboard.php">Dashboard</a>
            
            <div class="dropdown">
                <a href="#" class="dropbtn">Configuration ▾</a>
                <div class="dropdown-content">
                    <a href="trainees_view.php">Trainee</a>
                    <a href="course_fee_view.php">Course Fee</a>
                </div>
            </div>
            
            <a href="#">About</a>
            <a href="logout.php">Logout</a>
            <div class="profile">👤</div>
        </div>
    </div>

    <h1> Trainee Details </h1>

    <div class="search-container">
        <input type="text" id="search" placeholder="Search by Name, Email or Course" onkeyup="searchTable()">
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
            <tr>
                <td>IT-101</td>
                <td>Alex Rivera</td>
                <td>a.rivera@email.com</td>
                <td>Male</td>
                <td>Full-Stack</td>
                <td><span class="status paid">Paid</span></td>
                <td>
                    <button class="btn btn-edit">Edit</button>
                    <button class="btn btn-delete">Delete</button>
                </td>
            </tr>
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
                for (let j = 0; j < cells.length - 1; j++) {
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