<?php
class MasterController extends Controller {
    public function masterDashboard() {
        $user = new User();
        $room = new Room();
        $reservation = new Reservation();

        $userData = $user->getUserById((int)$_SESSION["user_id"]);

        $adminList = $user->getAdmins();
        $roomList = $room->getAllRooms(); 
        $reservationList = $reservation->getReservationsWithData();

        $this->viewWithData("master/master-dashboard", ["user" => $userData, "admins"=> $adminList, "rooms"=> $roomList, "reservations"=> $reservationList]);
        
    }

    public function adminRegistration() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $email = $_POST["email"];

            require_once "../config/config.php";
            require_once __DIR__ ."/../core/Validator.php";

            $newAdmin = new User();

            $errors = [];

            /* Error Handlers */
            /* Error Handlers End*/

            try {
                $newAdmin->regAdmin($username, $password, $email);
                header("location: " . BASE_URL . "/master-dashboard");
                die();
            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }
        } else {
            $this->view("layouts/reg-form");
        }
    }

    public function showAdmin() {
        if(isset($_GET["user_id"])) {
            $user_id = (int)$_GET["user_id"];
            $userModel = new User();

            $admin = $userModel->getUserById($user_id);

            $this->viewWithData("layouts/update-form", ["user" => $admin]);
        } else {
            die();
        }
    }

    public function deleteAdmin() {
        if(isset($_GET["user_id"])) {
            $user_id = (int) $_GET["user_id"];
            $adminModel = new User();

            try {
                $adminModel->getUserById( $user_id );
                $adminModel->delete($user_id);
                header("location: ". BASE_URL . "/master-dashboard");
            } catch (PDOException $e) {
                die("Query failed: ". $e->getMessage());
            }
        } else {
            $this->view("master/master-dashboard");
        }
    }

    public function adminUpdate() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_id = $_POST["user_id"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $email = $_POST["email"];

            require_once "../config/config.php";
            require_once __DIR__ ."/../core/Validator.php";

            $updateAdmin = new User();

            $errors = [];

            /* Error Handlers */
            /* Error Handlers End*/

            try {

                $updateAdmin->updateAdmin($user_id, $username, $password, $email);
                
                header("location: ". BASE_URL . "/master-dashboard");
            } catch(PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }
        } else {
            $this->view("layouts/update-form");
        }
    }


}
?>