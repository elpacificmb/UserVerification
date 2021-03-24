<?php
  require_once 'controllers/authController.php';

  if (isset($_GET['token'])) {
    $token = $_GET['token'];
    verifyUser($token);
  }

  if (!isset($_SESSION['id'])) {
    header('location: login.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <!-- Bootstrap Css -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Custom Style -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form-div login">

        <?php if(isset($_SESSION['message'])): ?>
          <div class="alert <?php echo $_SESSION['alert-class']; ?>">
            <?php
              echo $_SESSION['message'];
              unset($_SESSION['message']); 
              unset($_SESSION['alert-class']);
            ?>
          </div>
        <?php endif; ?>

        <h3>Welcome, <?php echo $_SESSION['username']; ?></h3>

        <a href="index.php?logout=1" class="logout">Logout</a>

        <?php if(!$_SESSION['verified']): ?>
          <div class="alert alert-warning">
            You need to verify your account.
            Go to your email account and click on the verification link we just emailed you at
            <strong><?php echo $_SESSION['email']; ?></strong>
          </div>
        <?php else: ?>
          <button class="btn btn-primary w-100 btn-lg">I am verified</button>
        <?php endif; ?>

      </div>
    </div>
  </div>

  <!-- Bootstrap Js and Popper -->
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>