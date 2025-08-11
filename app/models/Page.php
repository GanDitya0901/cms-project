<?php
declare(strict_types= 1);
class Page {
    private PDO $pdo;
    public function __construct() {
        $this->pdo = require __DIR__ . "/../../config/configDb.php";

        if(!$this->pdo instanceof PDO) {
            die("db.php did not return instance of PDO");
        }

        $this->pdo = $pdo;
    }

    public function createPage(string $title, string $slug) {
        $query = "INSERT INTO pages (title, slug) VALUES (:title, :slug)";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":title", $title); 
        $stmt->bindParam(":slug", $slug);

        $stmt->execute();
    }

    public function editPage(string $title, string $slug, int $page_id) {
        $query = "UPDATE pages SET 
        title=:title, slug=:slug WHERE page_id=:page_id";

        $stmt = $this->pdo->prepare($query);

        $data = [
            ":title"=> $title, 
            ":slug"=> $slug, 
            ":page_id"=> $page_id
        ];

        $stmt->execute($data);
    }

    public function deletePage(int $page_id) {
        $query = "DELETE FROM pages WHERE page_id=:page_id";

        $stmt = $this->pdo->prepare($query);
        
        $data = [":page_id"=> $page_id];

        $stmt->execute($data);
    }

    public function getAllPages() {
        $query = "SELECT * FROM pages";

        $stmt = $this->pdo->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPageById(int $page_id) {
        $query = "SELECT * FROM pages WHERE page_id=:page_id";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":page_id", $page_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>