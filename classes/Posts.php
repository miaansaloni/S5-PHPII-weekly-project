<?php

require_once './db.php';

class Posts {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllPosts() {
        $stmt = $this->conn->query("SELECT * FROM posts");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPost($title, $director, $year, $summary, $review) {
        $stmt = $this->conn->prepare("INSERT INTO posts (title, director, year, summary, review) VALUES (:title, :director, :year, :summary, :review)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':director', $director);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':summary', $summary);
        $stmt->bindParam(':review', $review);
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function readPost($id) {
        $stmt = $this->conn->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePost($id, $title, $director, $year, $summary, $review) {
        $stmt = $this->conn->prepare("UPDATE posts SET title = :title, director = :director, year = :year, summary = :summary, review = :review WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':director', $director);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':summary', $summary);
        $stmt->bindParam(':review', $review);
        
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    

    public function deletePost($id) {
        $stmt = $this->conn->prepare("DELETE FROM posts WHERE id = :id");
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>
