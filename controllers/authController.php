<?php

  session_start();

  require 'config/db.php';
  require_once 'emailController.php';

  $errors = array();
  $username = "";
  $email = "";

  // If User clicks on the Register Button
  if (isset($_POST['registerBtn'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    //Validation
    if (empty($username)) {
      $errors['username'] = "Username Required";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Email is invalid";
    }

    if (empty($email)) {
      $errors['email'] = "Email Required";
    }

    if (empty($password)) {
      $errors['password'] = "Password Required";
    }

    if ($password !== $confirmPassword) {
      $errors['password'] = "The 2 Passwords do not match";
    }

    $emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($emailQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    $stmt->close();

    if ($userCount > 0) {
      $errors['email'] = "Email already exists";
    }

    if (count($errors) === 0) {
      $password = password_hash($password, PASSWORD_DEFAULT);
      $token = bin2hex(random_bytes(50));

      $verified = false;

      $sql = "INSERT INTO users (username, email, verified, token, password) VALUES (?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('ssbss', $username, $email, $verified, $token, $password);

      if ($stmt->execute()) {
        //login user
        $user_id = $conn->insert_id;
        $_SESSION['id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['verified'] = $verified;

        sendVerificationEmail($email, $token);
        
        //set flash messge
        $_SESSION['message'] = "You are now logged in!";
        $_SESSION['alert-class'] = "alert-success";
        header('location: index.php');
        exit();

      } else {
        $errors['db_error'] = "Database error: failed to register";
      }
      $stmt->close();

    }

  }

  // If User clicks on the Login Button
  if (isset($_POST['loginBtn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // $email = $_POST['username'];

    //Validation
    if (empty($username)) {
      $errors['username'] = "Username Required";
    }

    if (empty($password)) {
      $errors['password'] = "Password Required";
    }

    if (count($errors) === 0) {
      $sql = "SELECT * FROM users WHERE username=? OR email=? LIMIT 1";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('ss', $username, $username);
      $stmt->execute();
      $result = $stmt->get_result();
      $user = $result->fetch_assoc();
      $stmt->close();
      //var_dump($user);

      if (isset($user)) {
        if (password_verify($password, $user['password'])) {
          //login success
          $_SESSION['id'] = $user['id'];
          $_SESSION['username'] = $user['username'];
          $_SESSION['email'] = $user['email'];
          $_SESSION['verified'] = $user['verified'];
  
          //set flash messge
          $_SESSION['message'] = "You are now logged in!";
          $_SESSION['alert-class'] = "alert-success";
          header('location: index.php');
          exit();
  
        } else {
          $errors['login_fail'] = "Wrong creditials";
        }
      } else {
        $errors['login_fail'] = "Wrong creditials";
      }
      
    }

  }

  //Logout user
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['verified']);
    header('location: login.php');
    exit();
  }

  //Verify user by token
  function verifyUser($token) {
    global $conn;
    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      $user = mysqli_fetch_assoc($result);
      $updateQuery = "UPDATE users SET verified=1 WHERE token='$token'";

      if (mysqli_query($conn, $updateQuery)) {
        //log user in
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['verified'] = 1;
  
        //set flash messge
        $_SESSION['message'] = "Your email was successfully verified!";
        $_SESSION['alert-class'] = "alert-success";
        header('location: index.php');
        exit();
      }
    } else {
      echo 'User not found';
    }

  }