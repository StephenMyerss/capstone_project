<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
    <style>
        .login-container {
          max-width: 400px;
          margin: 100px auto;
          padding: 20px;
          background-color: #fff;
          border-radius: 5px;
          box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
      </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-dark">
            <a href="../index.php" class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img class="innovation-logo" src="../innovationImages/smrt_logo_light.png" alt="">
            </a>
            <ul class="nav align-items-center">
                <li class="nav-item fs-5"><a href="../index.php" class="color nav-link" draggable="true">Back to home</a></li>
            </ul> 
        </header>
    </div>
    <div class="container fs-5">
        <div class="login-container">
          <h2 class="mb-4">Admin Login</h2>
          <form id="loginForm">
            <div class="form-group mb-3">
              <label for="username">Username</label>
              <input type="text" class="form-control border-3" id="username" name="username" required>
            </div>
            <div class="form-group mb-3">
              <label for="password">Password</label>
              <input type="password" class="form-control border-3" id="password" name="password" required>
            </div>
            <div class="form-group form-check mb-3">
              <input type="checkbox" class="form-check-input border-4" id="rememberMe">
              <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <div class="text-center">
                <button name="submit" type="login" class="button-color button-width fs-5 btn btn-primary fw-bold">Login</button>
            </div>
          </form>
        </div>
      </div>
      
      <!-- Bootstrap JS and jQuery (optional) -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      
      <!-- Custom JavaScript -->
      <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
          event.preventDefault(); // Prevent form submission
          var username = document.getElementById('username').value;
          var password = document.getElementById('password').value;
          var rememberMe = document.getElementById('rememberMe').checked;
          // Perform login logic here (e.g., send data to server)
          console.log("Username:", username);
          console.log("Password:", password);
          console.log("Remember Me:", rememberMe);
          // Reset form fields
          document.getElementById('loginForm').reset();
        });
      </script>
    <div class="container mt-auto">
        <footer class="py-3 my-4 border-top border-dark ">
            <p class="text-center text-body-secondary">© 2024 Cameron University Capstone</p>
        </footer>
    </div>
</body>
</html>