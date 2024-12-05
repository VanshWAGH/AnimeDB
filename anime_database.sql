-- Create the anime_db database
CREATE DATABASE IF NOT EXISTS anime_db;

-- Use the anime_db database
USE anime_db;

-- Create the anime table
CREATE TABLE IF NOT EXISTS anime (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    genre VARCHAR(255),
    release_year INT,
    rating DECIMAL(2, 1),
    review TEXT,
    status ENUM('Watching', 'Completed', 'On Hold', 'Dropped')
);

-- Insert sample data (optional)
INSERT INTO anime (title, genre, release_year, rating, review, status) VALUES
('Attack on Titan', 'Action', 2013, 9.0, 'Epic survival tale against titans.', 'Completed'),
('My Hero Academia', 'Action', 2016, 8.5, 'Young heroes in training.', 'Watching');
