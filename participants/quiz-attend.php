<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="quiz-styles.css">
    <style>
        .timer {
            font-size: 24px;
            font-weight: bold;
            color: red;
            margin-bottom: 20px;
            position: fixed;
            margin-right: 0;
            margin-left: 700px;
            background-color: black;
            padding: 5px;
        }
    </style>
    <script>
        let timeLeft = 1800; // Initial time in seconds

        function startTimer() {
            const timerElement = document.getElementById('timer');
            const interval = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(interval);
                    document.getElementById('python').submit();
                } else {
                    timerElement.textContent = `Time left: ${timeLeft} seconds`;
                    timeLeft--; // Decrement timeLeft every second
                }
            }, 1000); // Update every second (1000 ms)
        }

        window.onload = function() {
            startTimer();
            disableRefresh(); // Call the function to disable refresh
        };

        function disableRefresh() {
            document.addEventListener('keydown', function(e) {
                if ((e.key === 'r' || e.key === 'R') && (e.ctrlKey || e.metaKey)) {
                    e.preventDefault();
                } else if (e.key === 'F5') {
                    e.preventDefault();
                }
            });
        }

        function updateTime() {
            document.getElementById('timeTaken').value = timeLeft;
        }
    </script>
</head>

<body>
    <div class="quiz-container">
        <div class="timer" id="timer">Time left: 1800 seconds</div>
        <form action="" method="post" id="python" onsubmit="updateTime()">
            <h1>QUIZ PRELIMS</h1>
            <input type="hidden" name="timeTaken" id="timeTaken" value="0">
            <?php
            include_once '../connection/connection.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process quiz submission
                $sql = "SELECT question_id, answer FROM question";
                $result = $con->query($sql);

                $score = 0;
                if ($result->num_rows > 0) {
                    $questionNumber = 1;
                    while ($row = $result->fetch_assoc()) {
                        $questionId = $row['question_id'];
                        $correctAnswer = $row['answer'];

                        if (isset($_POST['q' . $questionNumber]) && $_POST['q' . $questionNumber] == $correctAnswer) {
                            $score++;
                        }
                        $questionNumber++;
                    }
                }

                // Update participant's score and time taken
                $lotNo = $_SESSION['lot_no'];
                $timeTaken = $_POST['timeTaken'];
                $timeTakenMinutesSeconds = gmdate("i:s", 1800 - $timeTaken); // Calculate time in minutes:seconds format
                
                $updateSql = "UPDATE participants SET score = ?, time_taken = ? WHERE lot_no = ?";
                $stmt = $con->prepare($updateSql);
                $stmt->bind_param("isi", $score, $timeTakenMinutesSeconds, $lotNo);
                $stmt->execute();
                $stmt->close();

                header('Location: submit.html');
                exit(); // Ensure script stops after redirection
            } else {
                // Display quiz questions
                $sql = "SELECT question_id, question_name, option1, option2, option3, option4 FROM question";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    $questionNumber = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="question">';
                        echo '<p>' . $questionNumber . '. ' . $row["question_name"] . '</p>';
                        echo '<label><input type="radio" name="q' . $questionNumber . '" value="A" required> a) ' . $row["option1"] . '</label><br>';
                        echo '<label><input type="radio" name="q' . $questionNumber . '" value="B"> b) ' . $row["option2"] . '</label><br>';
                        echo '<label><input type="radio" name="q' . $questionNumber . '" value="C"> c) ' . $row["option3"] . '</label><br>';
                        echo '<label><input type="radio" name="q' . $questionNumber . '" value="D"> d) ' . $row["option4"] . '</label><br>';
                        echo '</div>';
                        $questionNumber++;
                    }
                } else {
                    echo "0 results";
                }
            }

            $con->close();
            ?>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>

</html>
