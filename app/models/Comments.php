<?php
declare(strict_types= 1);

class Comments {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = require __DIR__ . "/../../config/configDb.php";

        if(!$this->pdo instanceof PDO) {
            die("db.php did not return a PDO instance");
        }

        $this->pdo = $pdo;
    }

    public function createComment(string $comment_text, int $user_id, int $post_id) {
        $query = "INSERT INTO comments (commment_text, created_at, user_id, post_id) 
        VALUES (:comment_text, NOW(), :user_id, :post_id)";

        $stmt = $this->pdo->prepare($query);
        
        $stmt->bindParam(":comment_text", $comment_text);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":post_id", $post_id);

        $stmt->execute();
    }

    public function showAllComments() {
        $query = "SELECT * FROM comments";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>