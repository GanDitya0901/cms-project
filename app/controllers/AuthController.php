<?php
declare(strict_types=1);
class AuthController extends Controller
{
    public function loginForm()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"] ?? "";
            $password = $_POST["password"] ?? "";

            require_once "../config/config.php";
            require_once __DIR__ . "/../core/Validator.php";

            $errors = [];

            try {

                $user = new User();
                $result = $user->getUser($username);

                /* var_dump($password);
                var_dump($result["password"]);
                var_dump(password_verify($password, $result["password"]));
                die(); */

                /* Error Handlers */
                if (Validator::isEmpty($username, $password)) {
                    $errors["empty_inputs"] = "Please fill in all the fields";
                }

                $invalidUsername = Validator::invalidUsername($result);

                if ($invalidUsername) {
                    $errors["invalid_username"] = "Invalid user credentials";
                } else if (Validator::invalidPass($password, $result["password"])) {
                    $errors["invalid_password"] = "Invalid password";
                }

                if ($errors) {
                    $_SESSION["errors"] = $errors;

                    header("location: " . BASE_URL . "/login");
                    die();
                }
                /* Error Handlers End */

                $newSessionId = session_create_id();
                $sessionId = $newSessionId . "_" . $result["user_id"];
                session_id($sessionId);

                /* require_once "../config/configSession.php"; */

                $_SESSION["user_id"] = $result["user_id"];
                $_SESSION["user_username"] = htmlspecialchars($result["username"]);
                $_SESSION["last_regenaration"] = time();

                $role = $result["role"];

                if ($role === "master_admin") {
                    header("location: " . BASE_URL . "/master-dashboard");
                } else if ($role === "admin") {
                    header("location: " . BASE_URL . "/admin-dashboard");
                } else {
                    header("location: " . BASE_URL . "/landing-page");
                }

                die();

            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }
        } else {
            $this->view("auth/login");
        }
    }
    public function regForm()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $email = $_POST["email"];

            require_once "../config/config.php";
            require_once __DIR__ . "/../core/Validator.php";

            $newUser = new User();

            $errors = [];

            /* Error Handlers */
            if(Validator::isEmptyReg($username, $password, $email)) {
                $errors["invalid_inputs"] = "Please fill in all the fields";
            }

            if(Validator::invalidEmail($email)) {
                $errors["invalid_email"] = "Invalid email";
            }

            if($newUser->usernameTaken($username)) {
                $errors["username_taken"] = "Username is already taken";
            }

            if($newUser->emailTaken($email)) {
                $errors["email_taken"] = "Email is already taken";
            }

            if($errors) {
                $_SESSION["errors"] = $errors;
                header("location: " . BASE_URL . "/register");
                die();
            }
            /* Error Handlers End */

            try {

                $newUser->regUser($username, $password, $email);

                header("location: " . BASE_URL . "/login");
                die();

            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }

        } else {
            $this->view("auth/register");
        }
    }

    public function logout() {
        $_SESSION = [];

        if(ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(), '', time() - 42000,
                $params['path'], 
                $params['domain'],
                $params['secure'],
                $params['httponly'],
            );
        }

        session_destroy();
        header('location: '. BASE_URL . '/login');
        die();
    }
}
?>