<?php
$connection = new mysqli(
    "localhost",
    "root",
    "",
    "simple_blog",
    "8111",
);


if ($connection->connect_error) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
