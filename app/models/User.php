<?php
declare(strict_types= 1);

class User {
    private PDO $pdo;
    public function __construct() {
        $this->pdo = require __DIR__ . "/../../config/configDb.php";

        if(!$this->pdo instanceof PDO) {
            die("db.php did not return a PDO instance");
        }

        $this->pdo = $pdo;
    }

    public function regUser(string $username, string $password, string $email, string $role="guest") {
        $query = "INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, :role)";

        $stmt = $this->pdo->prepare($query);

        $options = [
            "cost" => 12
        ];

        $hashedPass = password_hash($password, PASSWORD_BCRYPT, $options);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hashedPass);
        $stmt->bindParam(":email", $email); 
        $stmt->bindParam(":role", $role);

        $stmt->execute();
    }

    public function regAdmin(string $username, string $password, string $email, string $role= "admin") {
        $query = "INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, :role)";

        $stmt = $this->pdo->prepare($query);

        $options = [
            "cost" => 12
        ];

        $hashedPass = password_hash($password, PASSWORD_BCRYPT, $options);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hashedPass);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":role", $role);

        $stmt->execute();
    }

    public function getUser(string $username) {
        $query = "SELECT * FROM users WHERE username=:username";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserById(int $user_id) {
        $query = "SELECT * FROM users WHERE user_id=:user_id";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserEmail(string $email) {
        $query = "SELECT * FROM users WHERE email=:email";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function usernameTaken(string $username) {
        $query = "SELECT user_id FROM users WHERE username=:username";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function emailTaken(string $email) {
        $query = "SELECT user_id FROM users WHERE email=:email";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAdmins() {
        $query = "SELECT * FROM users WHERE role='admin'";

        $stmt = $this->pdo->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateAdmin(int $user_id, string $username, string $password, string $email) {
        $query = "UPDATE users SET 
        username=:username, 
        password=:password, 
        email=:email WHERE user_id=:user_id AND role='admin'";

        $stmt = $this->pdo->prepare($query);

        $options = [
            "cost" => 12
        ];

        $hashedPass = password_hash($password, PASSWORD_BCRYPT, $options);

        $data = [
            ":username" => $username,
            ":password" => $hashedPass, 
            ":email"=> $email, 
            ":user_id" => $user_id
        ];

        $stmt->execute($data);
    }

    public function delete(int $user_id) {
        $query = "DELETE FROM users WHERE user_id=:user_id";

        $stmt = $this->pdo->prepare($query);

        $data = [":user_id" => $user_id];

        $stmt->execute($data);
    }
}
?>