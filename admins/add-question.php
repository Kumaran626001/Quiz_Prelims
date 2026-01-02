<?php
// Start session
session_start();

if(isset($_SESSION['role'])){
   if($_SESSION['role'] != 'admin'){
    header('Location:../logout.php');
   }
}
else{
    header('Location:../logout.php');
}

// Example initialization
$sidebarExpanded = true; // or false, depending on your logic

// Get the current path
$currentPath = $_SERVER['REQUEST_URI'];

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
require '../connection/connection.php';

$result = $con->query("SELECT COUNT(*) AS total FROM question");
$totalQuestions = $result->fetch_assoc()['total'];

if (isset($_POST['submit'])) {
    // Retrieve form data
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct = $_POST['correct'];

    // Insert data into the question table
    $sql = "INSERT INTO question (question_name, option1, option2, option3, option4, answer) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $con->prepare($sql);

    // Check if prepare statement was successful
    if ($stmt === false) {
        die("Error in prepare statement: " . $con->error);
    }

    $stmt->bind_param("ssssss", $question, $option1, $option2, $option3, $option4, $correct);

    // Check if bind_param was successful
    if ($stmt === false) {
        die("Error in bind_param: " . $stmt->error);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = "Question added successfully";
        // Update total questions after adding a new one
        $_SESSION['totalQuestions']++;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question</title>
   
    <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/all.min.css">
    <link rel="stylesheet" href="../boot/css/bootstrap.min.css" class="css">
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
                <div class="container mt-3">
                    <h1>Add Questions</h1>
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo "<div class='alert alert-success' id='successMessage'>" . $_SESSION['message'] . "</div>";
                        unset($_SESSION['message']);
                    }
                    ?>
                    <div class="mb-2">
                        <p style="display:inline-block; font-weight : bold; margin-right:30px">Current Question: <?php echo $totalQuestions + 1; ?></p>
                        <p style="display:inline-block;; font-weight : bold;">Total Questions: <?php echo $totalQuestions ?></p>
                    </div>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="question">Question Name</label>
                            <input type="text" class="form-control" id="question" name="question" required>
                        </div>
                        <div class="form-group">
                            <label for="option1">Option (A)</label>
                            <input type="text" class="form-control" id="option1" name="option1" required>
                        </div>
                        <div class="form-group">
                            <label for="option2">Option (B)</label>
                            <input type="text" class="form-control" id="option2" name="option2" required>
                        </div>
                        <div class="form-group">
                            <label for="option3">Option (C)</label>
                            <input type="text" class="form-control" id="option3" name="option3" required>
                        </div>
                        <div class="form-group">
                            <label for="option4">Option (D)</label>
                            <input type="text" class="form-control" id="option4" name="option4" required>
                        </div>
                        <div class="form-group">
                            <label for="correct">Correct Answer</label>
                            <input type="text" class="form-control" id="correct" name="correct" required placeholder="Enter option only...">
                        </div>
                        <input type="submit" class="btn btn-primary" value="Add Question" name="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Hide the success message after 1.3 seconds
        setTimeout(function() {
            var successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 1300);
    </script>
    <script src="script.js"></script>
</body>
</html>
