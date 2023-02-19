<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>read</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

</body>

</html>

<?php

require_once "config.php";

// Establishing database connection using PDO
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Query to fetch records sorted by datetime in descending order
$query = "SELECT * FROM Afspraak ORDER BY appointmentDateTime DESC";

// Prepare the statement
$stmt = $pdo->prepare($query);

// Execute the statement
$stmt->execute();

// Check if any record found
if ($stmt->rowCount() > 0) {
    // Output the data in a table
    echo "<table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>nailColors</th>
                    <th>telephone</th>
                    <th>email</th>
                    <th>treatmentType</th>
                    <th>appointmentdate</th>
                    <th>options</th>
                </tr>
            </thead>
            <tbody>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Output each row
        // $colors = implode(", ", $_POST["nailColors"]);
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nailColors']}</td>
                <td>{$row['telephone']}</td>
                <td>{$row['email']}</td>
                <td>{$row['treatmentType']}</td>
                <td>{$row['appointmentDateTime']}</td>
                <td>
                    <a href='delete.php?id={$row['id']}' class='delete'>delete</a>
                    <a href='update.php?id={$row['id']}' class='update'>update</a>
                </td>
              
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "No records found.";
}

// Close the database connection
$conn = null;
?>