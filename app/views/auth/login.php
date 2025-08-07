<?php
$errors = $_SESSION["errors"] ?? [];
unset($errors);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CMS-Project</title>
  <link rel="stylesheet" href="../public/assets/css/login-page.css" />
</head>

<body>
  <div class="container">
    <div class="login-box">
      <div class="login-image">
        <img src="../public/assets/uploads/img1.jpg" alt="Login Image" />
      </div>
      <div class="login-form">
        <h2>Sign In</h2>

        <?php if (!empty($errors)): ?>
          <?php foreach ($errors as $error): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
          <?php endforeach; ?>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/login" method="POST">
          <label>Username</label>
          <input type="text" name="username" placeholder="Enter username" />


          <label>Password</label>
          <input type="password" name="password" placeholder="Enter password" />


          <button type="submit" class="sign-in">Sign In</button>


          <div class="options">
            <label>
              <input type="checkbox" />
              Remember Me
            </label>
            <a href="#">Forgot Password</a>
          </div>

          <p class="signup-link">Not a member? <a href="<?= BASE_URL ?>/register">Sign Up</a></p>
        </form>
      </div>
    </div>
  </div>
</body>

</html>