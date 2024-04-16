<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Référence</title>
</head>
<body>

<h2>Référence de l'hôtel</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="destination">Destination:</label>
    <select name="destination" id="destination">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Voyage_Borges";

        // Connexion à la base de données
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, pays FROM Destination";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["pays"] . "</option>";
            }
        } else {
            echo "0 résultats";
        }
        $conn->close();
        ?>
    </select>
    <br><br>
    <label for="date_arrive">Date d'arrivée:</label>
    <input type="text" id="date_arrive" name="date_arrive">
    <br><br>
    <label for="date_depart">Date de départ:</label>
    <input type="text" id="date_depart" name="date_depart">
    <br><br>
    <label for="nbr_personne">Nombre de personnes:</label>
    <input type="number" id="nbr_personne" name="nbr_personne" min="1">
    <br><br>
    <input type="submit" name="submit" value="Vérifier disponibilité">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $destination_id = $_POST['destination'];
    $date_arrive = $_POST['date_arrive'];
    $date_depart = $_POST['date_depart'];
    $nbr_personne = $_POST['nbr_personne'];

    // Connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT nom, etoile FROM Hotel WHERE id_destination = $destination_id AND id_reservation NOT IN (
                SELECT id_reservation FROM Reservation
                WHERE ('$date_arrive' BETWEEN date_arrive AND date_depart)
                OR ('$date_depart' BETWEEN date_arrive AND date_depart)
            )";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Hôtels disponibles:</h3>";
        while($row = $result->fetch_assoc()) {
            echo "Nom: " . $row["nom"] . " - Étoiles: " . $row["etoile"] . "<br>";
        }
    } else {
        echo "Aucun hôtel disponible pour les dates spécifiées.";
    }
    $conn->close();
}
?>

</body>
</html>