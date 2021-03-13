<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <!-- Bootstrap Css -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Custom Style -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form-div">
        <form action="register.php" method="post">
          <h3 class="text-center">Register</h3>

          <!-- <div class="alert alert-danger">
            <li>Username required</li>
          </div> -->

          <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control form-control-lg">
          </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control form-control-lg">
          </div>

          <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control form-control-lg">
          </div>

          <div class="mb-3">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" name="confirmPassword" class="form-control form-control-lg">
          </div>

          <div class="mb-3">
            <button type="submit" name="registerBtn" class="btn btn-primary w-100 btn-lg">Sign Up</button>
          </div>

          <p class="text-center">Already a member? <a href="login.php">Sign In</a></p>

        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap Js and Popper -->
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>