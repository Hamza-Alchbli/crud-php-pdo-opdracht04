<!DOCTYPE html>
<html>

<head>
    <title>Formulier</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <form action="create.php" method="post">
        <label>Kies 4 basiskleuren voor uw nagels:</label><br>
        <input type="color" name="nailColors[]" value="#FF0000" required>
        <input type="color" name="nailColors[]" value="#00FF00" required>
        <input type="color" name="nailColors[]" value="#0000FF" required>
        <input type="color" name="nailColors[]" value="#FFFF00" required><br><br>

        <label>Telefoonnummer:</label><br>
        <input type="tel" id="telephone" name="telephone" required pattern="^\+31\s6\s\d{3}\s\d{2}\s\d{2}$" placeholder="+31 6 234 51 41">
        <label>E-mailadres:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Afspraak datum/tijd:</label><br>
        <input type="datetime-local" name="appointmentDateTime" required><br><br>

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
        <input type="reset" value="Reset">
        <input type="submit" value="Verzenden">

        <input type="hidden" name="datumtijd" value="<?php echo date('Y-m-d H:i:s'); ?>">
    </form>
</body>

</html>