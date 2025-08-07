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
                <h2>Register Admin</h2>

                <form action="<?= BASE_URL ?>/reg-form" method="POST">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Enter username" />

                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter password" />

                    <label>Email</label>
                    <input type="text" name="email" placeholder="Enter email" />

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