<?php
// Get the database connection
$pdo = new PDO('mysql:host=localhost;dbname=Nailstudio', 'username', 'password');

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $id = $_POST['id'];
    $kleuren = $_POST['kleuren'];
    $telefoonnummer = $_POST['telefoonnummer'];
    $email = $_POST['email'];
    $afspraakdatum = $_POST['afspraakdatum'];
    $behandeling = implode(", ", $_POST['behandeling']);

    // Prepare the update statement
    $stmt = $pdo->prepare("UPDATE Afspraak SET kleuren = :kleuren, telefoonnummer = :telefoonnummer, email = :email, afspraakdatum = :afspraakdatum, behandeling = :behandeling WHERE id = :id");

    // Bind the parameters
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':kleuren', $kleuren);
    $stmt->bindParam(':telefoonnummer', $telefoonnummer);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':afspraakdatum', $afspraakdatum);
    $stmt->bindParam(':behandeling', $behandeling);

    // Execute the update statement
    if ($stmt->execute()) {
        // Redirect to the index page with a success message
        header('Location: index.php?message=success');
        exit();
    } else {
        // Redirect to the index page with an error message
        header('Location: index.php?message=error');
        exit();
    }
} else {
    // Display the update form
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM Afspraak WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch();
?>
    <!-- HTML code for the update form -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <!-- Add the form fields for the other columns here -->
        <input type="submit" name="submit" value="Update">
    </form>
<?php
}
?>