<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
require '../connection/connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the question ID
    $id = $_POST['id'];

    // Prepare the SQL query to delete the question
    $sql = "DELETE FROM question WHERE question_id = ?";

    // Initialize the prepared statement
    if ($stmt = $con->prepare($sql)) {
        // Bind the parameter
        $stmt->bind_param("i", $id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Question deleted successfully.";
        } else {
            echo "Error deleting question: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
    }

    // Close the database connection
    $con->close();
} else {
    echo "Invalid request method.";
}
?>
