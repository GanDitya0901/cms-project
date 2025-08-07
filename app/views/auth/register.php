<?php
$errors = $_SESSION["errors"] ?? [];
unset($errors);
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale-1.0" />
<link rel="stylesheet" href="../public/assets/css/register-page.css" />
<title>CMS-Project</title>

<body>
    <div class="container">
        <div class="signup-box">
            <div class="signup-image">
                <img src="../public/assets/uploads/img1.jpg" alt="signup Image" />
            </div>
            <div class="signup-form">
                <h2>Register</h2>

                <?php if (!empty($errors)): ?>
                    <?php foreach ($errors as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>/register" method="post">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Enter username"  />

                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter password"  />

                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter Email"  />

                    <button type="submit" class="sign-up">Register</button>

                    <p class="login-link">Already have an account? <a href="<?= BASE_URL ?>/login">Login</a></p>
                </form>

                <?php
                // checkErrors();
                ?>
            </div>
        </div>
    </div>
</body>

</html>