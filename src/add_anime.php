<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $release_year = $_POST['release_year'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("INSERT INTO anime (title, genre, release_year, rating, review, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $genre, $release_year, $rating, $review, $status]);

    header("Location: ../index.php");
    exit();
}
?>
