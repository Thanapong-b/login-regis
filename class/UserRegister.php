<?php

    class UserRegister {
        private $conn;
        private $table_name = "user";

        public $name;
        public $email;
        public $password;
        public $confirm_password;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setPassword($password) {
            $this->password = $password;
        }

        public function setConfirmPassword($confirm_password) {
            $this->confirm_password = $confirm_password;
        }

        public function validatePassword() {
            if ($this->password !== $this->confirm_password) {
                return false;
            }

            return true;

        }

        public function checkPasswordLength() {
            if (strlen($this->password) < 6) {
                return false;
            }

            return true;
        }

        public function validateUserInput() {
            if (!$this->checkPasswordLength() || !$this->validatePassword() || $this->checkEmailExists()) {
                return false;
            }
            return true;
        }

        public function createUser() {
            // validate user email address    
            if (!$this->validateUserInput()) {
                return false; // email already exists
            }

            $query = "INSERT INTO {$this->table_name} (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));

            // hash the password
            $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $hashed_password);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function checkEmailExists() {
            $query = "SELECT id FROM {$this->table_name} WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true; // email exists
            } else {
                return false;// email does not exist
            }
        }
    }

?>