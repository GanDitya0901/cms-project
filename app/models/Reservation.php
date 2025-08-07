<?php
declare(strict_types=1);

class Reservation
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = require __DIR__ . "/../../config/configDb.php";

        if (!$this->pdo instanceof PDO) {
            die("db.php did not return a PDO instance");
        }

        $this->pdo = $pdo;
    }

    public function makeReservation(string $check_in, string $check_out, int $room_id, int $user_id)
    {
        $roomPrice = $this->getRoomPrice($room_id);

        $nights = (strtotime($check_out) - strtotime($check_in)) / (60 * 60 * 24);

        $totalPrice = $roomPrice * $nights;

        $query = "INSERT INTO reservations (check_in, check_out, total, user_id, room_id, created_at) 
        VALUES (:check_in, :check_out, :total, :user_id, :room_id, NOW())";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":check_in", $check_in);
        $stmt->bindParam(":check_out", $check_out);
        $stmt->bindParam(":total", $totalPrice);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":room_id", $room_id);

        $stmt->execute();
    }

        public function getRoomPrice(int $room_id)
    {
        $query = "SELECT price FROM rooms WHERE room_id=:room_id";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":room_id", $room_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new Exception("Room not found or query failed");
        }

        $pricePerNight = (float) $result["price"];
        return $pricePerNight;
    }

    public function updateReservation()
    {

    }

    public function deleteRerservation(int $reservation_id)
    {
        $query = "DELETE FROM reservations WHERE reservation_id=:reservation_id";

        $stmt = $this->pdo->prepare($query);

        $data = [":reservation_id" => $reservation_id];

        $stmt->execute($data);
    }

    public function getAllReservations()
    {
        $query = "SELECT * FROM reservations";

        $stmt = $this->pdo->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getReservationById(int $reservation_id)
    {
        $query = "SELECT * FROM reservations WHERE reservation_id=:reservation_id";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":reservation_id", $reservation_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getReservationsWithData() {
        $query = "SELECT r.reservation_id, r.check_in, r.check_out, 
        rm.room_type, r.total, u.username, r.created_at FROM reservations r 
        JOIN users u ON r.user_id = u.user_id 
        JOIN rooms rm ON r.room_id = rm.room_id 
        ORDER BY r.created_at ASC";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>