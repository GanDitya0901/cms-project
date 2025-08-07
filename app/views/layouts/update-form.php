<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CMS-Project</title>
    <link rel="stylesheet" href="../public/assets/css/reg-form.css" />
</head>

<body>
    <div class="container">
        <div class="reg-box">
            <div class="reg-form">
                <h2>Update Admin</h2>

                <form action="<?= BASE_URL ?>/admin-update" method="POST">
                    <input type="hidden" name="user_id" value="<?= $user["user_id"] ?>">
                    <label>Username</label>
                    <input type="text" name="username" value="<?= $user["username"] ?>" />

                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter password" />

                    <label>Email</label>
                    <input type="text" name="email" value="<?= $user["email"] ?>" />

                    <div class="button-row">
                        <a href="<?= BASE_URL ?>/master-dashboard" class="back-btn">Back</a>
                        <button class="submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>