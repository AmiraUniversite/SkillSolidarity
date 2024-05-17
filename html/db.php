<?php
// db.php: PostgreSQL database connection script using pg_connect

// Database connection settings
$host = 'localhost';
$dbname = 'Site2';
$user = 'postgres';
$password = 'amira';
$port = '5432'; // default port for PostgreSQL, change if different
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";

// Function to connect to the database
function connectDb() {
    global $connection_string;
    $conn = pg_connect($connection_string);
    if ($conn) {
        
        return $conn;
    } else {
        echo "Error in connecting to PostgreSQL database.\n";
        return false;
    }
}
?>
