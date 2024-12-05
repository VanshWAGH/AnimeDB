    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Anime Database</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body>
        <!-- Background Video -->
        <div class="background-overlay">
            <video autoplay loop muted>
                <source src="backgroud2.mp4" type="video/mp4">
            </video>
        </div>

        <!-- Navbar -->
        <nav class="navbar">
            <div class="logo">AnimeDB</div>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="genres.html">Genres</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="#">My List</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Anime Database Management System</h1>

            <!-- Add Anime Form -->
            <div class="flash-card">
                <h2>Add Anime</h2>
                <form action="src/add_anime.php" method="POST">
                    <input type="text" name="title" placeholder="Anime Title" required>
                    <input type="text" name="genre" placeholder="Genre">
                    <input type="number" name="release_year" placeholder="Release Year" min="1900" max="2100" required>
                    <input type="number" name="rating" placeholder="Rating (0-10)" step="0.1" min="0" max="10">
                    <textarea name="review" placeholder="Your Review"></textarea>
                    <select name="status">
                        <option value="Watching">Watching</option>
                        <option value="Completed">Completed</option>
                        <option value="On Hold">On Hold</option>
                        <option value="Dropped">Dropped</option>
                    </select>
                    <button type="submit">Add Anime</button>
                </form>
            </div>

            <!-- Anime List -->
            <h2>Anime List</h2>
            <div id="anime-list">
                <?php include 'src/list_anime.php'; ?>
            </div>
        </div>
    </body>
    </html>
