<?php

use Dom\Comment;
class GuestController extends Controller
{
    public function landingPage()
    {
        $user = new User();
        $reservation = new Reservation();
        $room = new Room();
        $post = new Post();

        $userData = $user->getUserById((int) $_SESSION["user_id"]);
        $reservationData = $reservation->getAllReservations();
        $roomData = $room->getAllRooms();
        $postData = $post->getAllPosts();

        $this->viewWithData("guest/landing-page", [
            "user" => $userData,
            "reservations" => $reservationData,
            "room" => $roomData,
            "post" => $postData
        ]);
    }

    public function bookRoom()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $check_in = $_POST["check_in"];
            $check_out = $_POST["check_out"];
            $user_id = (int) $_POST["user_id"];
            $room_id = (int) $_POST["room_id"];

            require_once "../config/config.php";

            $newReservation = new Reservation();

            try {
                $newReservation->makeReservation($check_in, $check_out, $room_id, $user_id);
                header("location: " . BASE_URL . "/landing-page");

            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }
        } else {
            $this->view("guest/landing-page");
        }
    }

    public function showRoomGuest()
    {
        if (isset($_GET["room_id"])) {
            $room_id = (int) $_GET["room_id"];

            $roomModel = new Room();
            $userModel = new User();

            $room = $roomModel->getRoomById($room_id);
            $user = $userModel->getUserById((int) $_SESSION["user_id"]);

            $this->viewWithData("layouts/room-page", ["room" => $room, "user" => $user]);
        }
    }

    public function makeComment()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $comment = $_POST["comment_text"];
            $user_id = (int) $_SESSION["user_id"];
            $post_id = $_POST["post_id"];

            require_once "../config/config.php";

            $newComment = new Comments();

            try {
                $newComment->createComment($comment, $user_id, $post_id);
                header("location: " . BASE_URL . "/landing-page");

                die();
            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }
        } else {
            $this->view("layout/post-view");
        }
    }

    public function showPost()
    {
        if (isset($_GET["post_id"])) {
            $post_id = (int) $_GET["post_id"];

            $postModel = new Post();
            $userModel = new User();
            $commentModel = new Comments();

            $post = $postModel->getPostById($post_id);
            $user = $userModel->getUserById((int) $_SESSION["user_id"]);
            $commments = $commentModel->getAllComments($post_id);

            $this->viewWithData("layouts/post-view", ["post" => $post, "user" => $user, "comment" => $commments]);
        }
    }
}
?>