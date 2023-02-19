<?php
// Retrieve the ID of the record to be deleted from the URL query string
$id = $_GET['id'];

require_once "config.php";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement
    $stmt = $pdo->prepare('DELETE FROM Afspraak WHERE id = :id');

    // Bind the ID parameter to the prepared statement
    $stmt->bindParam(':id', $id);

    // Execute the prepared statement
    $result = $stmt->execute();
    if ($result) {
        echo "Het record is verwijderd";
        header('Refresh:3; url=read.php');
    } else {
        echo "Het record is niet verwijderd";
        header('Refresh:3; url=read.php');
    }
    // Redirect to the homepage
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}
