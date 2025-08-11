<?php

use Random\Engine\Secure;
class AdminController extends Controller
{

    public function adminDashboard()
    {
        $user = new User();
        $room = new Room();
        $reservation = new Reservation();
        $post = new Post();

        $roomList = $room->getAllRooms();
        $reservationList = $reservation->getReservationsWithData();
        $postList = $post->getAllPosts();
        $userData = $user->getUserById((int) $_SESSION["user_id"]);

        $this->viewWithData("admin/admin-dashboard", [
            "user" => $userData,
            "rooms" => $roomList,
            "reservations" => $reservationList,
            "posts" => $postList
        ]);
    }

    public function roomCreation()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $room_type = $_POST["room_type"];
            $price = $_POST["price"];
            $max_cap = $_POST["max_capacity"];
            $total_avail = $_POST["total_available"];
            $descriptions = $_POST["descriptions"];
            $filename = $_FILES["image"]["name"];

            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $allowedTypes = array("jpeg", "jpg", "png", "gif");
            $tempName = $_FILES["image"]["tmp_name"];
            $targetPath = __DIR__ . "/../../public/assets/uploads/" . $filename;

            require_once "../config/config.php";

            $newRoom = new Room();

            try {
                if (in_array($ext, $allowedTypes)) {
                    if (move_uploaded_file($tempName, $targetPath)) {
                        $newRoom->createRoom($room_type, $price, $max_cap, $total_avail, $descriptions, $filename);
                        header("location: " . BASE_URL . "/admin-dashboard");
                        die();
                    }
                }
            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }
        } else {
            $this->view("layouts/createRoom-form");
        }
    }

    public function showRooms()
    {
        if (isset($_GET["room_id"])) {
            $room_id = (int) $_GET["room_id"];

            $roomModel = new Room();

            $room = $roomModel->getRoomById($room_id);
            $this->viewWithData("layouts/updateRoom-form", ["room" => $room]);
        }
    }

    public function roomUpdate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $room_id = $_POST["room_id"];
            $room_type = $_POST["room_type"];
            $price = $_POST["price"];
            $max_cap = $_POST["max_capacity"];
            $total_avail = $_POST["total_available"];
            $descriptions = $_POST["descriptions"];
            $filename = $_FILES["image"]["name"];

            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $allowedTypes = array("jpeg", "jpg", "png", "gif");
            $tempName = $_FILES["image"]["tmp_name"];
            $targetPath = __DIR__ . "/../../public/assets/uploads/" . $filename;

            require_once "../config/config.php";

            $updateRoom = new Room();

            try {
                if (in_array($ext, $allowedTypes)) {
                    if (move_uploaded_file($tempName, $targetPath)) {
                        $updateRoom->updateRoom($room_id, $room_type, $price, $max_cap, $total_avail, $descriptions, $filename);
                        header("location: " . BASE_URL . "/admin-dashboard");
                    }
                }
            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }
        } else {
            $this->view("layouts/udateRoom-form");
        }
    }

    public function deleteRoom()
    {
        if (isset($_GET["room_id"])) {
            $room_id = (int) $_GET["room_id"];
            $roomModel = new Room();

            try {
                $roomModel->getRoomById($room_id);
                $roomModel->deleteRoom($room_id);
                header("location: " . BASE_URL . "/admin-dashboard");

                die();
            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }
        } else {
            $this->view("admin/admin-dashboard");
        }
    }

    public function postCreation()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_id = (int) $_SESSION["user_id"];
            $title = $_POST["title"];
            $body = $_POST["body"];
            $filename = $_FILES["image"]["name"];

            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $allowedTypes = array("jpeg", "jpg", "png", "gif");
            $tempName = $_FILES["image"]["tmp_name"];
            $targetPath = __DIR__ . "/../../public/assets/uploads/" . $filename;

            require_once "../config/config.php";

            $newPost = new Post();

            try {
                if (in_array($ext, $allowedTypes)) {
                    if (move_uploaded_file($tempName, $targetPath)) {
                        $newPost->createPost($title, $body, $user_id, $filename);
                        header("location: " . BASE_URL . "/admin-dashboard");

                        die();
                    }
                }
            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }

        } else {
            $this->view("layouts/post-form");
        }
    }

    public function showPost()
    {
        if (isset($_GET["post_id"])) {
            $post_id = (int) $_GET["post_id"];

            $postModel = new Post();
            $userModel = new User();

            $post = $postModel->getPostById($post_id);
            $user = $userModel->getUserById((int) $_SESSION["user_id"]);

            $this->viewWithData("layouts/updatePost-form", ["post" => $post, "user" => $user]);
        }
    }

    public function updatePost()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $post_id = (int) $_POST["post_id"];
            $body = $_POST["body"];
            $title = $_POST["title"];
            $filename = $_FILES["image"]["name"];

            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $allowedTypes = array('jpeg', 'jpg', 'png', 'gif');
            $tempName = $_FILES['image']['tmp_name'];
            $targetPath = __DIR__ . "/../../public/assets/uploads/" . $filename;

            require_once "../config/config.php";

            $updatePost = new Post();

            try {
                if (in_array($ext, $allowedTypes)) {
                    if (move_uploaded_file($tempName, $targetPath)) {
                        $updatePost->updatePost($title, $body, $post_id, $filename);
                        header("location: " . BASE_URL . "/admin-dashboard");

                        die();
                    }
                }
            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }
        } else {
            $this->view("layouts/admin-dashboard");
        }
    }

   public function postDelete()
    {
        if (isset($_GET["post_id"])) {
            $post_id = (int) $_GET["post_id"];

            $postModel = new Post();

            try {
                $postModel->getPostById($post_id);
                $postModel->postDeletion($post_id);
                header("location: " . BASE_URL . "/admin-dashboard");

                die();
            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }

        } else {
            $this->view("admin/admin-dashboard");
        }
    }

    public function pageCreation()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST["title"];
            $slug = $_POST["slug"];

            require_once "../config/config.php";

            $newPage = new Page();

            try {
                $newPage->createPage($title, $slug);
                header("location: " . BASE_URL . "/");

                die();
            } catch (PDOException $e) {
                die("QUery failed: " . $e->getMessage());
            }
        } else {
            $this->view("/");
        }
    }

    public function showPage()
    {
        if (isset($_GET["page_id"])) {
            $page_id = (int) $_GET["post_id"];

            $userModel = new User();
            $pageModel = new Page();

            $user = $userModel->getUserById((int) $_SESSION["user_id"]);
            $page = $pageModel->getPageById($page_id);

            $this->viewWithData("/", ["user" => $user, "page" => $page]);
        }
    }

    public function pageUpdate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST["title"];
            $slug = $_POST["slug"];
            $post_id = $_POST["post_id"];

            require_once "../config/config.php";

            $updatePage = new Page();

            try {
                $updatePage->editPage($title, $slug, $post_id);
                header("location: " . BASE_URL . "/");

                die();
            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }
        } else {
            $this->view("/");
        }
    }

    public function sectionCreation() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $section_type = $_POST["section_type"];
            $position = (int) $_POST["position"];
            $page_id = (int) $_GET["page_id"];

            $content = json_encode([
                "heading"=> $_POST["heading"],
                "body"=> $_POST["body"],
                "background"=> $_POST["background"]
            ]);

            require_once "../config/config.php";

            $newSection = new Page_Sections();

            try {
                $newSection->addSection($section_type, $content, $position, $page_id);
                header("location: ". BASE_URL . "/");

                die();
            } catch (PDOException $e) {
                die("Query failed: ". $e->getMessage());
            }
        }
    }

    public function showSection() {
        if(isset($_GET["section_id"])) {
            $section_id = $_GET["section_id"];

            $sectionModel = new Page_Sections();
            $userModel = new User();

            $section = $sectionModel->getSectionById($section_id);
            $user = $userModel->getUserById((int) $_SESSION["user_id"]);

            $this->viewWithData("/", ["section"=> $section, "user"=> $user]);
        }
    }

    public function updateSection() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $section_id = $_POST["section_id"];
            $section_type = $_POST["section_type"];
            $position = $_POST["position"];
            $page_id = $_GET["page_id"];

            $content = json_encode([
                "heading"=> $_POST["heading"],
                "body"=> $_POST["body"],
                "background"=> $_POST["background"],
            ]);

            require_once "../config/config.php";

            $updateSection = new Page_Sections();

            try {
                $updateSection->editSection($section_type, $content, $position, $page_id, $section_id);
                header("location: " . BASE_URL ."/");
            } catch (PDOException $e) {
                die("Query failed: ". $e->getMessage());
            }
        }
    }

    public function deleteSection() {
        if(isset($_GET["section_id"])) {
            $section_id = $_GET["section_id"];

            $sectionModel = new Page_Sections();

            try {
                $sectionModel->getSectionById($section_id);
                $sectionModel->sectionDelete($section_id);
                header("location: ". BASE_URL ."/");

                die();
            } catch (PDOException $e) {
                die("Query failed: ". $e->getMessage());
            }
        }
    }
}
?>