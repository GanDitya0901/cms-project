<?php
declare(strict_types= 1);

class Page_Sections {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = require __DIR__ . "/../../config/configDb.php";

        if(!$this->pdo instanceof PDO) {
            die("db.php did not return instance of PDO");
        }

        $this->pdo = $pdo;
    }

    public function addSection(string $section_type, string $content, int $position, int $page_id) {
        $query = "INSERT INTO page_sections (section_type, content, position, page_id) 
        VALUES (:section_type, :content, :position, :page_id)";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":section_type", $section_type);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":postion", $position);
        $stmt->bindParam(":page_id", $page_id);

        $stmt->execute();
    }

    public function getAllSections() {
        $query = "SELECT * FROM page_sections";

        $stmt = $this->pdo->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSectionById(int $section_id) {
        $query = "SELECT * FROM page_sections WHERE section_id=:section_id";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":section_id", $section_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function editSection(string $section_type, string $content, int $position, int $page_id, int $section_id) {
        $query = "UPDATE page_sections 
        SET section_type=:section_type, content=:content, position=:position, 
        page_id=:page_id WHERE section_id=:section_id";

        $stmt = $this->pdo->prepare($query);

        $data = [
            ":section_type"=> $section_type,
            "content"=> $content,
            "position"=> $position, 
            ":page_id"=> $page_id,
            ":section_id"=> $section_id
        ];

        $stmt->execute($data);
    }

    public function sectionDelete(int $section_id) {
        $query = "DELETE FROM page_sections WHERE section_id=:section_id";

        $stmt = $this->pdo->prepare($query);

        $data = [
            ":section_id"=> $section_id
        ];

        $stmt->execute($data);
    }
}
?>