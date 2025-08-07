<?php
declare(strict_types= 1);

class Post {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = require __DIR__ . "/../../config/configDb.php";

        if(!$this->pdo instanceof PDO) {
            die("db.php did not return a PDO instance");
        }

        $this->pdo = $pdo;
    }

    public function createPost(string $title, string $body, int $author_id) {
        $query = "INSERT INTO posts (title, body, author_id) VALUES (:title, :body, :author_id)";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":body", $body);
        $stmt->bindParam(":author_id", $author_id);

        $stmt->execute();
    }

    public function updatePost(string $title, string $body, int $post_id) {
        $query = "UPDATE posts SET 
        title=:title, body=:body WHERE post_id=:post_id";

        $stmt = $this->pdo->prepare($query);

        $data = [
            ":title"=> $title,
            ":body"=> $body, 
            ":post_id"=> $post_id
        ];

        $stmt->execute($data);

    }

    public function deletePost(int $post_id) {
        $query = "DELETE FROM posts WHERE post_id=:post_id";

        $stmt = $this->pdo->prepare($query);

        $data = [":post_id"=> $post_id];

        $stmt->execute($data);
    }

    public function getAllPosts() {
        $query = "SELECT p.post_id, p.title, p.body, p.created_at, 
        p.updated_at, u.user_id, u.username FROM posts p 
        JOIN users u ON p.author_id = u.user_id 
        ORDER BY p.created_at ASC";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPostById(int $post_id) {
        $query = "SELECT * FROM posts WHERE post_id=:post_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":post_id", $post_id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllPostWithComment() {
        $query = "SELECT p.post_id, p.title, p.body, c.comment_id, c.comment, 
        c.created_at, u.user_id, u.username FROM posts p
        LEFT JOIN comments c ON c.post_id = p.post_id 
        LEFT JOIN users u ON u.user_id = c.user_id
        ORDER BY p.post_id, c.created_at ASC";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>