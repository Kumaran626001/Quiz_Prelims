<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
   <link rel="stylesheet" href="./boot/css/bootstrap.min.css" class="css">
  <style>
    .gradient-custom-2 {
      /* fallback for old browsers */
      background: #fccb90;

      /* Chrome 10-25, Safari 5.1-6 */
      background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

      /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
      background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
    }

    @media (min-width: 768px) {
      .gradient-form {
        height: 100vh !important;
      }
    }

    @media (min-width: 769px) {
      .gradient-custom-2 {
        border-top-right-radius: .3rem;
        border-bottom-right-radius: .3rem;
      }
    }
  </style>
</head>

<body>
  <section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">

                  <div class="text-center">
                    <img src="logo.jpg" style="width: 100px; height: 100px" alt="logo">
                    <h4 class="mt-1 mb-5 pb-1">Department of Information Technology</h4>
                  </div>

                  <form method="post" action="">

                    <div class="form-outline mb-4">
                      <label class="form-label" for="username">Username</label>
                      <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="password">Password</label>
                      <input type="password" placeholder="Password" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="text-center pt-1 mb-5 pb-1">
                      <button type="submit" name="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">Log
                        in</button>
                    </div>

                  </form>

                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                  <h4 class="mb-4">Welcome Everyone</h4>
                  <p class="medium mb-3">To get started, please log in using the following credentials:
                    </p>
                    <li>Username : student</li>
                    <li>Password : student</li>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php
  session_start();
  include_once("connection/connection.php");

  if (isset($_POST['submit'])) {
    $u = $_POST['username'];
    $p = $_POST['password'];
    $sql = "SELECT * FROM users";
    $r = mysqli_query($con, $sql);
    $loginSuccess = false;
    while ($row = mysqli_fetch_array($r)) {
      if ($u == $row["username"] && $p == $row["password"]) {
        $loginSuccess = true;
        if ($row["role"] == "admin") {
          
          $result = $con->query("SELECT COUNT(*) AS total FROM question");
          $totalQuestions = $result->fetch_assoc()['total'];
          $team_count = $con->query("SELECT COUNT(*) AS total FROM participants");
          $totalTeams = $team_count->fetch_assoc()['total'];
          $_SESSION['totalQuestions'] = $totalQuestions;
          $_SESSION['totalTeams'] = $totalTeams;

          $_SESSION['role'] = $row['role'];
          header("Location:admins/dashboard.php");
        } else {
          $_SESSION['role'] = $row['role'];
          header("Location:participants/rule.php");
        }
        exit;
      }
    }
    if (!$loginSuccess) {
  ?>
      <script>
        alert("Login failed");
      </script>
  <?php
    }
  }
  ?>
  <link rel="stylesheet" href="/boot/js/bootstrap.min.js">
</body>

</html>