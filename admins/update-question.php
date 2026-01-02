<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
require '../connection/connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $id = $_POST['id'];
    $question_name = $_POST['question_name'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $answer = $_POST['answer'];

    // Prepare the SQL query to update the question
    $sql = "UPDATE question SET 
            question_name = ?, 
            option1 = ?, 
            option2 = ?, 
            option3 = ?, 
            option4 = ?, 
            answer = ? 
            WHERE question_id = ?";

    // Initialize the prepared statement
    if ($stmt = $con->prepare($sql)) {
        // Bind the parameters
        $stmt->bind_param("ssssssi", $question_name, $option1, $option2, $option3, $option4, $answer, $id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Question updated successfully.";
        } else {
            echo "Error updating question: " . $stmt->error;
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
