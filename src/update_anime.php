<?php
// Include the database connection file
include 'db.php';

if (isset($_GET['id'])) {
    $anime_id = $_GET['id'];
    $sql = "SELECT * FROM anime WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$anime_id]);
    $anime = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$anime) {
        die("Anime not found.");
    }
} else {
    die("No anime ID provided.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? null;
    $genre = $_POST['genre'] ?? null;
    $release_year = $_POST['release_year'] ?? null;
    $rating = $_POST['rating'] ?? null;
    $review = $_POST['review'] ?? null;

    if ($title && $genre && $release_year && $rating !== null && $review) {
        $update_sql = "UPDATE anime SET title = ?, genre = ?, release_year = ?, rating = ?, review = ? WHERE id = ?";
        $update_stmt = $pdo->prepare($update_sql);
        
        if ($update_stmt->execute([$title, $genre, $release_year, $rating, $review, $anime_id])) {
            header("Location: ../index.php?message=Anime updated successfully");
            exit();
        } else {
            echo "Error updating anime: " . $update_stmt->errorInfo()[2];
        }
    } else {
        echo "Incomplete data provided.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Anime</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            overflow: hidden;
            font-family: Arial, sans-serif;
            color: #fff;
        }

        /* Video Background */
       /* Video Background */
.video-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: -1;
    opacity: 0.7;
    filter: brightness(2); /* Increase brightness */
}

.background-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6); /* Adjust to let more brightness through */
    z-index: 1;
}


        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0, 0, 0, 0.8);
            z-index: 2;
        }

        .navbar .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #e50914;
        }

        .nav-links {
            list-style: none;
            display: flex;
        }

        .nav-links li {
            margin-left: 1.5rem;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #e50914;
        }

        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            z-index: 2;
            position: relative;
            padding-top: 5rem;
        }

        .flash-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            width: 90%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
        }

        .flash-card h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #e50914;
        }

        form label {
            font-size: 1rem;
            color: #ccc;
            display: block;
            margin-bottom: 0.5rem;
        }

        form input[type="text"],
        form input[type="number"],
        form textarea {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: none;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.9);
            color: #333;
        }

        form button {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            background: #e50914;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        form button:hover {
            background: #d40813;
        }

    </style>
</head>
<body>
    <!-- Background Video -->
    <video autoplay muted loop class="video-bg">
        <source src="background.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Background Overlay -->
    <div class="background-overlay"></div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">AnimeDB</div>
        <ul class="nav-links">
            <li><a href="../index.php">Home</a></li>
            <li><a href="#">Genres</a></li>
            <li><a href="#">Top Rated</a></li>
            <li><a href="#">My List</a></li>
        </ul>
    </nav>

    <!-- Edit Anime Form -->
    <div class="main-content">
        <div class="flash-card">
            <h2>Edit Anime</h2>
            <form method="POST" action="">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($anime['title']); ?>" required>

                <label for="genre">Genre:</label>
                <input type="text" name="genre" id="genre" value="<?php echo htmlspecialchars($anime['genre']); ?>" required>

                <label for="release_year">Release Year:</label>
                <input type="number" name="release_year" id="release_year" value="<?php echo htmlspecialchars($anime['release_year']); ?>" required>

                <label for="rating">Rating (0-10):</label>
                <input type="number" name="rating" id="rating" min="0" max="10" value="<?php echo htmlspecialchars($anime['rating']); ?>" required>

                <label for="review">Your Review:</label>
                <textarea name="review" id="review" required><?php echo htmlspecialchars($anime['review']); ?></textarea>

                <button type="submit">Update Anime</button>
            </form>
        </div>
    </div>
</body>
</html>
