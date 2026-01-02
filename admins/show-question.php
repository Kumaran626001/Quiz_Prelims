<?php
session_start();
$sidebarExpanded = true;
if(isset($_SESSION['role'])){
  if($_SESSION['role'] != 'admin'){
   header('Location:../logout.php');
  }
}
else{
   header('Location:../logout.php');
}
$currentPath = $_SERVER['REQUEST_URI'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../connection/connection.php';

$sql = "SELECT * FROM question";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>

  <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/all.min.css">

  <link rel="stylesheet" href="edit-question.css">
  <link rel="stylesheet" href="sidebar.css" class="css">
  <link rel="stylesheet" href="../boot/css/bootstrap.min.css" class="css">

  <style>
     .edit,.delete {
            width: 1em;  /* Adjust size as needed */
            height: 1em; /* Adjust size as needed */
            display: inline-block;
            /* background-image: url('../bootstrap-icons-1.11.3/pencil-fill.svg'); */
            background-size: contain;
            background-repeat: no-repeat;
            margin-right: 18px;
          
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
          <div class="container">
            <div class="container-xl">
              <div class="table-responsive">
                <div class="table-wrapper">
                  <div class="table-title">
                    <div class="row">
                      <div class="col-sm-6">
                        <h2>Manage <b>Questions</b></h2>
                      </div>
                    </div>
                  </div>
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Questions</th>
                        <th>Option(A)</th>
                        <th>Option(B)</th>
                        <th>Option(C)</th>
                        <th>Option(D)</th>
                        <th>Correct Option</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($result->num_rows > 0) {
                        $sno = 1;
                        while ($row = $result->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>" . $sno . "</td>";
                          echo "<td>" . $row['question_name'] . "</td>";
                          echo "<td>" . $row['option1'] . "</td>";
                          echo "<td>" . $row['option2'] . "</td>";
                          echo "<td>" . $row['option3'] . "</td>";
                          echo "<td>" . $row['option4'] . "</td>";
                          echo "<td>" . $row['answer'] . "</td>";
                          echo "<td>";
                          echo "<a href='#' class='edit' data-id='" . $row['question_id'] . "'><img src='../bootstrap-icons-1.11.3/pencil-fill.svg' alt='Edit' data-toggle='tooltip' title='Edit'>
</a>";
                          echo "<a href='#' class='delete' data-id='" . $row['question_id'] . "'><img src='../bootstrap-icons-1.11.3/trash-fill.svg' alt='Delete' data-toggle='tooltip' title='Delete'>
</a>";
                          echo "</td>";
                          echo "</tr>";
                          $sno++;
                        }
                      } else {
                        echo "<tr><td colspan='8'>No questions found</td></tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
   document.addEventListener('DOMContentLoaded', (event) => {
  // Edit functionality
  document.querySelectorAll('.edit').forEach(editButton => {
    editButton.addEventListener('click', function() {
      const row = this.closest('tr');
      const cells = row.querySelectorAll('td');
      document.getElementById('editQuestionId').value = this.getAttribute('data-id');
      document.getElementById('editQuestionName').value = cells[1].innerText;
      document.getElementById('editOption1').value = cells[2].innerText;
      document.getElementById('editOption2').value = cells[3].innerText;
      document.getElementById('editOption3').value = cells[4].innerText;
      document.getElementById('editOption4').value = cells[5].innerText;
      document.getElementById('editAnswer').value = cells[6].innerText;
      $('#editQuestionModal').modal('show');
    });
  });

  // Update functionality
  document.getElementById('editQuestionForm').addEventListener('submit', function(event) {
    event.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'update-question.php',
      data: $(this).serialize(),
      success: function(response) {
        alert('Question updated successfully');
        location.reload();
      },
      error: function() {
        alert('Failed to update the question');
      }
    });
  });

  // Delete functionality
  document.querySelectorAll('.delete').forEach(deleteButton => {
    deleteButton.addEventListener('click', function() {
      const row = this.closest('tr');
      const id = this.getAttribute('data-id');
      document.getElementById('deleteQuestionId').value = id;
      $('#deleteQuestionModal').modal('show');
    });
  });

  // Handle delete form submission
  document.getElementById('deleteQuestionForm').addEventListener('submit', function(event) {
    event.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'delete-question.php',
      data: $(this).serialize(),
      success: function(response) {
        alert('Question deleted successfully');
        location.reload();
      },
      error: function() {
        alert('Failed to delete the question');
      }
    });
  });
});

  </script>

  <script src="../jQuery/jQuery3.7.1.js"></script>
  <script src="../boot/js/bootstrap.min.js"></script>
  <script src="script.js"></script>
  <!-- Edit Question Modal -->
  <div id="editQuestionModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="editQuestionForm">
          <div class="modal-header">
            <h4 class="modal-title">Edit Question</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="editQuestionId" name="id">
            <div class="form-group">
              <label>Question</label>
              <input type="text" id="editQuestionName" name="question_name" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Option A</label>
              <input type="text" id="editOption1" name="option1" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Option B</label>
              <input type="text" id="editOption2" name="option2" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Option C</label>
              <input type="text" id="editOption3" name="option3" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Option D</label>
              <input type="text" id="editOption4" name="option4" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Correct Option</label>
              <input type="text" id="editAnswer" name="answer" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-info" value="Save">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Delete Question Modal -->
<div id="deleteQuestionModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="deleteQuestionForm">
        <div class="modal-header">
          <h4 class="modal-title">Delete Question</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="deleteQuestionId" name="id">
          <p>Are you sure you want to delete this question?</p>
          <p class="text-warning"><small>This action cannot be undone.</small></p>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-danger" value="Delete">
        </div>
      </form>
    </div>
  </div>
</div>

</body>

</html>
