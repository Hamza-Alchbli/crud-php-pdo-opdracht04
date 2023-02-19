<?php

require_once "config.php";

// Maak een PDO-verbinding met de database
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // zet de PDO error mode naar exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Check of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verzamel de gegevens van het formulier
    $nailColors =  implode(", ", $_POST["nailColors"]);
    $telephone = $_POST["telephone"];
    $pattern = "/^\+31\s6\s\d{3}\s\d{2}\s\d{2}$/"; // The pattern to match

    if (!preg_match($pattern, $telephone)) {
        echo "Not a valid pattern";
        header('Refresh:2; url=index.php');
        exit();
    }
    $email = $_POST["email"];
    $appointmentDateTime = $_POST["appointmentDateTime"];
    if (isset($_POST['treatmentType'])) {
        $treatmentType = implode(", ", $_POST['treatmentType']);
    } else {
        $treatmentType = '';
    }
    $formDateTime = date('Y-m-d H:i:s');

    // Bereid de SQL-query voor met behulp van prepared statements
    $stmt = $pdo->prepare("INSERT INTO Afspraak (nailColors, telephone, email, appointmentDateTime, treatmentType, formDateTime) VALUES (:nailColors, :telephone, :email, :appointmentDateTime, :treatmentType, :formDateTime)");

    // Bind de parameters aan de prepared statement
    $stmt->bindParam(":nailColors", $nailColors);
    $stmt->bindParam(":telephone", $telephone);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":appointmentDateTime", $appointmentDateTime);
    $stmt->bindParam(":treatmentType", $treatmentType);
    $stmt->bindParam(":formDateTime", $formDateTime);

    // Voer de prepared statement uit om de gegevens in de database op te slaan
    $result = $stmt->execute();

    if ($result) {
        echo "Er is een nieuw record gemaakt in de database.";
        header('Refresh:2; url=read.php');
    } else {
        echo "Er is geen nieuw record gemaakt.";
        header('Refresh:2; url=read.php');
    }
}
