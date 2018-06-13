<?php 
    class Category {
        private $conn;
        private $table = 'categories';

        public $id;
        public $name;
        public $created_at;

        // constructor to take instance of database connection

        function __construct($db) {
            $this->conn = $db;
        }

        // Read Data from categories table
        public function read() {

            $query = "SELECT id, name, created_at FROM " .$this->table. "";
            // Prepare the statement
            $stmt = $this->conn->prepare($query);
            // Execute query
            $stmt->execute();
            return $stmt;
        }

        public function create() {
            // insert query
            $query = "INSERT INTO " .$this->table. " (name, created_at) VALUES (:name, now())";

            // prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->name = htmlspecialchars(strip_tags($this->name));

            $stmt->bindParam(':name', $this->name);

            if($stmt->execute()) {
                return true;
            }

            return false;
        }

        public function update() {
            // QUERY
            $query = "UPDATE " .$this->table. " SET name = :name WHERE id = :id";

            // PREPARE THE STATEMENT
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()) {
                return true;
            } 
            return false;
        }

        public function delete() {
            // QUERY
            $query = "DELETE FROM " .$this->table. " WHERE id = :id";

            // PREPARE THE STATEMENT

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()) {
                return true;
            }

            return false;
        }
    }
?>