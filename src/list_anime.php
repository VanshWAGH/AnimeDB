<?php
include 'db.php';

$stmt = $pdo->query("SELECT * FROM anime ORDER BY release_year DESC");
$animeList = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table>";
echo "<tr><th>Title</th><th>Genre</th><th>Release Year</th><th>Rating</th><th>Review</th><th>Status</th><th>Actions</th></tr>";
foreach ($animeList as $anime) {
    echo "<tr>";
    echo "<td>{$anime['title']}</td>";
    echo "<td>{$anime['genre']}</td>";
    echo "<td>{$anime['release_year']}</td>";
    echo "<td>{$anime['rating']}</td>";
    echo "<td>{$anime['review']}</td>";
    echo "<td>{$anime['status']}</td>";
    echo "<td>
            <a href='src/update_anime.php?id={$anime['id']}'>Edit</a> |
            <a href='src/delete_anime.php?id={$anime['id']}'>Delete</a>
          </td>";
    echo "</tr>";
}
echo "</table>";
?>
