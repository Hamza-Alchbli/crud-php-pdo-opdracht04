<?php
require_once "config.php";

// Maak een PDO-verbinding met de database
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $id = $_POST['id'];
    $nailColors = implode(", ", $_POST["nailColors"]);
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $appointmentDateTime = $_POST['appointmentDateTime'];
    // var_dump($_POST['treatmentType']);
    if (isset($_POST['treatmentType'])) {
        $treatmentType = implode(", ", $_POST['treatmentType']);
    } else {
        $treatmentType = '';
    }

    // Prepare the update statement
    $stmt = $pdo->prepare("UPDATE Afspraak SET nailColors = :nailColors, telephone = :telephone, email = :email, appointmentDateTime = :appointmentDateTime, treatmentType = :treatmentType WHERE id = :id");

    // Bind the parameters
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nailColors', $nailColors);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':appointmentDateTime', $appointmentDateTime);
    $stmt->bindParam(':treatmentType', $treatmentType);

    // Execute the update statement
    // Voer de prepared statement uit om de gegevens in de database op te slaan
    $result = $stmt->execute();

    if ($result) {
        echo "Update is gelukt";
        header('Refresh:2; url=read.php');
    } else {
        echo "Update is niet gelukt";
        header('Refresh:2; url=read.php');
    }
} else {
    // Display the update form
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM Afspraak WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch();
    $nailColors = explode(",", $row['nailColors']);
?>
    <!-- HTML code for the update form -->

    <head>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label>Kies 4 basiskleuren voor uw nagels:</label><br>
        <input type="color" name="nailColors[]" value="<?= $nailColors[0]; ?>" required>
        <input type="color" name="nailColors[]" value="<?= $nailColors[1]; ?>" required>
        <input type="color" name="nailColors[]" value="<?= $nailColors[2]; ?>" required>
        <input type="color" name="nailColors[]" value="<?= $nailColors[3]; ?>" required><br><br>

        <label>Telefoonnummer:</label><br>
        <input type="tel" id="telephone" value="<?php echo $row['telephone']; ?>" name="telephone" required pattern="^\+31\s6\s\d{3}\s\d{2}\s\d{2}$" placeholder="+31 6 234 51 41">
        <label>E-mailadres:</label><br>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>

        <label>Afspraak datum/tijd:</label><br>
        <input type="datetime-local" value="<?php echo $row['appointmentDateTime']; ?>" name="appointmentDateTime" required><br><br>

        <label>Soort behandeling:</label>
        <div class="checks">
            <label>
                <input type="checkbox" name="treatmentType[]" value="Nagelbijt">
                Nagelbijt arrangment (termijnbetaling mogelijk) &euro;180
            </label>
            <label>
                <input type="checkbox" name="treatmentType[]" value="Luxe manicure">
                Luxe manicure (massage en handpakking) &euro;30,00
            </label>
            <label>
                <input type="checkbox" name="treatmentType[]" value="Nagelreparatie">
                Nagelreparatie per nagel (in eerste week gratis) &euro;5,00
            </label>
        </div>
        <input type="hidden" name="datumtijd" value="<?php echo date('Y-m-d H:i:s'); ?>">
        <input type="submit" name="submit" value="Update">
    </form>
<?php
}
?>