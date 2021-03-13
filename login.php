<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap Css -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Custom Style -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form-div login">
        <form action="login.php" method="post">
          <h3 class="text-center">Login</h3>

          <!-- <div class="alert alert-danger">
            <li>Username required</li>
          </div> -->

          <div class="mb-3">
            <label for="username">Username or Email</label>
            <input type="text" name="username" class="form-control form-control-lg">
          </div>

          <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control form-control-lg">
          </div>

          <div class="mb-3">
            <button type="submit" name="loginBtn" class="btn btn-primary w-100 btn-lg">Log In</button>
          </div>

          <p class="text-center">Not yet a member? <a href="register.php">Sign Up</a></p>

        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap Js and Popper -->
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>