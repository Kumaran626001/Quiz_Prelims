<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition Rules</title>
   <link rel="stylesheet" href="../boot/css/bootstrap.min.css" class="css">
   <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3>Competition Rules</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Total Questions:</strong> The quiz consists of a total of 30 questions.</p>
                        <p><strong>Eligibility for Finals:</strong> Teams with the highest points will be eligible for selection to the finals.</p>
                        <p><strong>Malpractices:</strong></p>
                        <ul>
                            <li>Any form of cheating, including switching to other windows, escaping from full-screen view, or opening other tabs, will result in disqualification and a penalty of minus points.</li>
                            <li>Teams are expected to remain in full-screen mode throughout the quiz.</li>
                        </ul>
                        <p><strong>Time Limit:</strong> Each question must be answered within the allotted time. Failure to do so will result in zero points for that question.</p>
                        <p><strong>Behavior:</strong> Team members must conduct themselves in a respectful and sportsmanlike manner. Any inappropriate behavior will lead to immediate disqualification.</p>
                        <p><strong>Technical Issues:</strong> In case of technical difficulties, notify the quiz administrator immediately. Deliberate attempts to exploit technical glitches will be considered cheating.</p>
                        <p><strong>Team Participation:</strong> Each team must consist of the designated members only. Substituting team members without prior approval is not allowed.</p>
                        <p><strong>Honesty:</strong> All participants must follow the honor code and answer questions to the best of their knowledge without external help.</p>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header bg-success text-white">
                        <h3>Fill in Your Details</h3>
                    </div>
                    <div class="card-body">
                        <form id="quizForm" action="submit_details.php" method="POST">
                            <div class="form-group">
                                <label for="lotNumber">Lot Number</label>
                                <input type="text" class="form-control" id="lotNumber" name="lotNumber" required>
                            </div>
                            <div class="form-group">
                                <label for="teamMember1">Team Member 1</label>
                                <input type="text" class="form-control" id="teamMember1" name="teamMember1" required>
                            </div>
                            <div class="form-group">
                                <label for="teamMember2">Team Member 2</label>
                                <input type="text" class="form-control" id="teamMember2" name="teamMember2" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Start Quiz</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../boot/js/bootstrap.min.js"></script>
</body>

</html>
