<?php
session_start();

// Check if user is admin
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != 'admin') {
        header('Location: ../logout.php');
    }
} else {
    header('Location: ../logout.php');
}

include_once '../connection/connection.php';

// Get the current path
$currentPath = $_SERVER['REQUEST_URI'];

// Example initialization
$sidebarExpanded = true; // or false, depending on your logic
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="add-quiz.css" class="css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/all.min.css">
   <link rel="stylesheet" href="../boot/css/bootstrap.min.css" class="css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="sidebar.css" class="css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 0.75rem;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    <div class="fluid-container">
        <div class="wrappers <?php echo $sidebarExpanded ? 'sidebar-expanded' : ''; ?>">
            <aside id="sidebar" class="<?php echo $sidebarExpanded ? 'expand' : ''; ?>">
                <div class="d-flex align-items-center p-1">
                    <button class="toggle-btn" type="button">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="sidebar-logo">
                        <h1 class="h1 text-white pt-3">VHNSNC</h1>
                    </div>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="dashboard.php" class="sidebar-link active">
                            <i class="fas fa-users" style="font-size: 16px;"></i>
                            <span class="h6">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="../index.php" class="sidebar-link">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="h6">Logout</span>
                        </a>
                    </li>
                </ul>
            </aside>
            <div class="main <?php echo $sidebarExpanded ? 'expanded' : ''; ?>">
                <div class="container mt-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white text-center">
                            <h2 class="mb-0">Top 5 Teams for Final Round</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.no</th>
                                        <th>Lot No</th>
                                        <th>Participant 1</th>
                                        <th>Participant 2</th>
                                        <th>Score</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch top 5 participants based on score and time taken
                                    $select_query = "SELECT * FROM participants ORDER BY score DESC, time_taken ASC LIMIT 5";
                                    $result = mysqli_query($con, $select_query);
                                    $sno = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $sno . "</td>";
                                        echo "<td>" . $row['lot_no'] . "</td>";
                                        echo "<td>" . $row['participant1'] . "</td>";
                                        echo "<td>" . $row['participant2'] . "</td>";
                                        echo "<td>" . $row['score'] . "</td>";
                                        echo "<td>" . $row['time_taken'] . "</td>";
                                        echo "</tr>";
                                        $sno++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-center">
                            <small style="color:black;">&copy; 2024 VHNSNC (Department of IT)</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>
