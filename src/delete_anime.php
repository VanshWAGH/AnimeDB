<?php
// Include your database connection file
include 'db.php'; // Adjust the path if necessary

if (isset($_GET['id'])) {
    // Get the anime ID from the URL
    $anime_id = $_GET['id'];

    // Prepare the SQL statement to delete the anime
    $sql = "DELETE FROM anime WHERE id = ?"; // Updated table name

    if ($stmt = $pdo->prepare($sql)) {
        // Bind the ID parameter
        $stmt->bindParam(1, $anime_id, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect or show a success message
            header("Location: ../index.php?message=Anime deleted successfully");
            exit();
        } else {
            // Show an error message
            echo "Error deleting anime: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Error preparing statement: " . $pdo->errorInfo()[2];
    }
} else {
    echo "No anime ID provided.";
}
?>
