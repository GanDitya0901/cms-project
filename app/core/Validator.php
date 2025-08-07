<?php
declare(strict_types=1);
class Validator {
    public static function isEmpty(string $username, string $password) {
        if(empty($username) || empty($password)) {
            return true;
        } else {
            return false;
        }
    }

    public static function invalidPass(string $password, string $hashedPass) {
        if(!password_verify($password, $hashedPass)) {
            return true;
        } else {
            return false;
        }
    }

    public static function invalidUsername(array|bool $result) {
        if(!$result) {
            return true;
        } else {
            return false;
        }
    }

    public static function isEmptyReg(string $username, string $password, string $email) {
        if(empty($username) || empty($password) || empty($email)) {
            return true;
        } else {
            return false;
        }
    }

    public static function invalidEmail(string $email) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
}
?>