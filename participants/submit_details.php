<?php
session_start();

// Include the database connection file
require '../connection/connection.php'; // Adjust the path as necessary

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lotNumber = $_POST['lotNumber'];
    $teamMember1 = $_POST['teamMember1'];
    $teamMember2 = $_POST['teamMember2'];

    // Check if the lot number already exists
    $checkSql = "SELECT * FROM participants WHERE lot_no = ?";
    $checkStmt = $con->prepare($checkSql);
    $checkStmt->bind_param("s", $lotNumber);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // Lot number already exists
        echo '<script>alert("Lot number already exists. Please use a different lot number.");</script>';
        echo '<script>window.location.href = "rule.php";</script>'; // Redirect back to the registration page
    } else {
        // Lot number does not exist, proceed with the insert
        $stmt = $con->prepare("INSERT INTO participants (lot_no, participant1, participant2) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $lotNumber, $teamMember1, $teamMember2);

        // Execute the statement
        if ($stmt->execute()) {
            // $_SESSION['teamMember1'] = $teamMember1;
            // $_SESSION['teamMember2'] = $teamMember2;
            $_SESSION['lot_no'] = $lotNumber;
            header('Location:quiz-attend.php');
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the check statement
    $checkStmt->close();
}

// Close the database connection
$con->close();
?>
