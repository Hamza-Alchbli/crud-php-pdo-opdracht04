<!DOCTYPE html>
<html>

<head>
    <title>Formulier</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <form action="submit.php" method="post">
        <label>Kies 4 basiskleuren voor uw nagels:</label><br>
        <input type="color" name="nagelkleur1" value="#FF0000" required>
        <input type="color" name="nagelkleur2" value="#00FF00" required>
        <input type="color" name="nagelkleur3" value="#0000FF" required>
        <input type="color" name="nagelkleur4" value="#FFFF00" required><br><br>

        <label>Telefoonnummer:</label><br>
        <input type="tel" id="telefoonnummer" name="telefoonnummer" required pattern="^\+31\s6\s\d{3}\s\d{2}\s\d{2}$" placeholder="+31 6 234 51 41">
        <label>E-mailadres:</label><br>
        <input type="email" name="emailadres" required><br><br>

        <label>Afspraak datum/tijd:</label><br>
        <input type="datetime-local" name="afspraak" required><br><br>

        <label>Soort behandeling:</label>
        <div class="checks">
            <label>
                <input type="checkbox" name="behandeling1" value="manicure">
                Nagelbijt arrangment (termijnbetaling mogelijk) &euro;180
            </label>
            <label>
                <input type="checkbox" name="behandeling2" value="pedicure">
                Luxe manicure (massage en handpakking) &euro;30,00
            </label>
            <label>
                <input type="checkbox" name="behandeling3" value="nagelverlenging">
                Nagelreparatie per nagel (in eerste week gratis) &euro;5,00
            </label>
        </div>
        <input type="reset" value="Reset">
        <input type="submit" value="Verzenden">

        <input type="hidden" name="datumtijd" value="<?php echo date('Y-m-d H:i:s'); ?>">
    </form>
</body>

</html>