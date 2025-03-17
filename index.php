<?php
$movies = [
    ["title" => "Inception", "genre" => "Sci-Fi", "rating" => 8.8, "release_year" => 2010, "duration" => 148, "box_office" => 829],
    ["title" => "Interstellar", "genre" => "Sci-Fi", "rating" => 8.6, "release_year" => 2014, "duration" => 169, "box_office" => 677],
    ["title" => "The Dark Knight", "genre" => "Action", "rating" => 9.0, "release_year" => 2008, "duration" => 152, "box_office" => 1005],
    ["title" => "Titanic", "genre" => "Romance", "rating" => 7.8, "release_year" => 1997, "duration" => 195, "box_office" => 2200],
    ["title" => "Avengers: Endgame", "genre" => "Action", "rating" => 8.4, "release_year" => 2019, "duration" => 181, "box_office" => 2797],
    ["title" => "Parasite", "genre" => "Thriller", "rating" => 8.6, "release_year" => 2019, "duration" => 132, "box_office" => 258]
];

echo "<h2>Movie Database Analytics</h2>";

// Display Movies in a Table
echo "<h3>Movie List</h3>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Title</th><th>Genre</th><th>Rating</th><th>Release Year</th><th>Duration</th><th>Box Office (M USD)</th></tr>";
foreach ($movies as $movie) {
    echo "<tr>
    <td>{$movie['title']}</td>
    <td>{$movie['genre']}</td>
    <td>{$movie['rating']}</td>
    <td>{$movie['release_year']}</td>
    <td>{$movie['duration']} min</td>
    <td>{$movie['box_office']} M</td>
    </tr>";
}
echo "</table>";

// Compute and display the average IMDb rating
$ratings = array_column($movies, 'rating');
$average_rating = array_sum($ratings) / count($ratings);
echo "<h3>Average IMDb Rating: " . number_format($average_rating, 2) . "</h3>";

// Find the highest and lowest rated movies
$highest_rating = max($ratings);
$lowest_rating = min($ratings);
$highest_movie = $movies[array_search($highest_rating, $ratings)]['title'];
$lowest_movie = $movies[array_search($lowest_rating, $ratings)]['title'];
echo "<h3>Highest Rated Movie: $highest_movie ($highest_rating)</h3>";
echo "<h3>Lowest Rated Movie: $lowest_movie ($lowest_rating)</h3>";

// Filter Movies by Genre (e.g., Action)
$filtered_movies = array_filter($movies, function($movie) {
    return $movie['genre'] === 'Action';
});
echo "<h3>Action Movies</h3><ul>";
foreach ($filtered_movies as $movie) {
    echo "<li>{$movie['title']} ({$movie['release_year']})</li>";
}
echo "</ul>";

// Sort Movies by Release Year (Descending Order)
usort($movies, function($a, $b) {
    return $b['release_year'] - $a['release_year'];
});
echo "<h3>Movies Sorted by Release Year (Newest to Oldest)</h3><ul>";
foreach ($movies as $movie) {
    echo "<li>{$movie['title']} ({$movie['release_year']})</li>";
}
echo "</ul>";

// Find the Total Box Office Collection
$box_office_totals = array_sum(array_column($movies, 'box_office'));
echo "<h3>Total Box Office Collection: \$$box_office_totals Million</h3>";

// Find the Longest and Shortest Movie
$durations = array_column($movies, 'duration');
$longest_movie = $movies[array_search(max($durations), $durations)]['title'];
$shortest_movie = $movies[array_search(min($durations), $durations)]['title'];
echo "<h3>Longest Movie: $longest_movie</h3>";
echo "<h3>Shortest Movie: $shortest_movie</h3>";

// Find Movies Released in the 2010s
$movies_2010s = array_filter($movies, function($movie) {
    return $movie['release_year'] >= 2010 && $movie['release_year'] < 2020;
});
echo "<h3>Movies from the 2010s</h3><ul>";
foreach ($movies_2010s as $movie) {
    echo "<li>{$movie['title']} ({$movie['release_year']})</li>";
}
echo "</ul>";
?>