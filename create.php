<?php

require_once "config.php";

// Maak een PDO-verbinding met de database
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // zet de PDO error mode naar exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Check of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verzamel de gegevens van het formulier
    $nailColors =  implode(", ", $_POST["nailColors"]);;
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $appointmentDateTime = $_POST["appointmentDateTime"];
    $treatmentType = implode(", ", $_POST["treatmentType"]);
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
    $stmt->execute();

    // Bevestig aan de gebruiker dat de afspraak is opgeslagen
    echo "Bedankt voor uw afspraak! Uw gegevens zijn opgeslagen.";
}
?>
