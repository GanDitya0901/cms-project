<?php
declare(strict_types=1);

class Room
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

    public function getRoomById(int $room_id) {
        $query = "SELECT * FROM rooms WHERE room_id=:room_id";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":room_id", $room_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllRooms() {
        $query = "SELECT * FROM rooms";

        $stmt = $this->pdo->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function createRoom(string $room_type, float $price, int $max_cap, int $total_avail, string $desc, string $fileName)
    {
        $query = "INSERT INTO rooms (room_type, price, max_capacity, total_available, descriptions, filename) 
        VALUES (:room_type, :price, :max_capacity, :total_available, :descriptions, :filename)";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":room_type", $room_type);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":max_capacity", $max_cap);
        $stmt->bindParam(":total_available", $total_avail);
        $stmt->bindParam(":descriptions", $desc);
        $stmt->bindParam(":filename", $fileName);

        $stmt->execute();
    }

    public function updateRoom(int $room_id, string $room_type, float $price, int $max_cap, int $total_avail, string $desc, string $fileName) {
        $query = "UPDATE rooms SET 
        room_type=:room_type, price=:price, max_capacity=:max_capacity, 
        total_available=:total_available, descriptions=:descriptions, 
        filename=:filename WHERE room_id=:room_id";

        $stmt = $this->pdo->prepare($query);

        $data = [
            ":room_type"=> $room_type,
            ":price"=> $price,
            ":max_capacity"=> $max_cap,
            ":total_available"=> $total_avail, 
            ":descriptions"=> $desc, 
            ":filename"=> $fileName, 
            ":room_id"=> $room_id
        ];

        $stmt->execute($data);
    }

    public function deleteRoom(int $room_id) {
        $query = "DELETE FROM rooms WHERE room_id=:room_id";

        $stmt = $this->pdo->prepare($query);

        $data = ["room_id" => $room_id];

        $stmt->execute($data);
    }
}
?>