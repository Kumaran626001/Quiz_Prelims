<?php
// Example initialization
session_start();
include '../connection/connection.php';
$sidebarExpanded = true; // or false, depending on your logic
if(isset($_SESSION['role'])){
    if($_SESSION['role'] != 'admin'){
     header('Location:../logout.php');
    }
 }
 else{
     header('Location:../logout.php');
 }
// Get the current path
$currentPath = $_SERVER['REQUEST_URI'];
$result = $con->query("SELECT COUNT(*) AS total FROM question");
$totalQuestions = $result->fetch_assoc()['total'];

$team_count = $con->query("SELECT COUNT(*) AS total FROM participants");
$totalTeams = $team_count->fetch_assoc()['total'];
// $_SESSION['totalQuestions'] = $totalQuestions;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../boot/css/bootstrap.min.css" class="css">

    <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/all.min.css">
    
    <link rel="stylesheet" href="" class="css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="sidebar.css" class="css">
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
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card bg-c-blue order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Total Questions</h6>
                                        <h2 class="text-right"><i class="fa fa-question-circle f-left"></i><span><?php echo $totalQuestions ?></span></h2>
                                        <a href="add-question.php" class="stretched-link"style="color:white;">
                                            <p class="m-b-0">Add Questions<span class="f-right"></span></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-c-yellow order-card">
                                <div class="card-block">
                                        <h6 class="m-b-20">View Questions</h6>
                                        <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span><?php echo $totalQuestions ?>/30</span></h2>
                                        <a href="show-question.php" class="stretched-link"style="color:white;">
                                            <p class="m-b-0">View Questions<span class="f-right"></span></p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card bg-c-green order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Total Teams</h6>
                                        <h2 class="text-right"><i class="fas fa-users f-left"></i><span><?php echo $totalTeams ?></span></h2>
                                        <a href="teams.php" class="stretched-link"style="color:white;">
                                            <p class="m-b-0">Teams<span class="f-right"></span></p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card bg-c-pink order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Results</h6>
                                        <h2 class="text-right"><i class="fas fa-check-circle f-left"></i><span>5/5</span></h2>
                                        <a href="view-result.php" class="stretched-link"style="color:white;">
                                            <p class="m-b-0">View Result<span class="f-right"></span></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>