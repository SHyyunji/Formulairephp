<?php
    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "voyage_borges";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation d'hôtel en Asie</title>
</head>
<body>
    <div class="container">
        <h2>Réservation d'hôtel en Asie</h2>
        <form action="" method="post">
            <label for="destination">Destination :</label>
            <select name="destination" id="destination">
                <?php
                    // Récupération des destinations depuis la base de données
                    $sql = "SELECT id, pays FROM destination";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id"] . "'>" . $row["pays"] . "</option>";
                        }
                    } else {
                        echo "0 résultats";
                    }
                    
                ?>
            </select>

            <label for="date_arrive">Date d'arrivée :</label>
            <input type="text" name="date_arrive" id="date_arrive" placeholder="Format : JJ/MM/AAAA">

            <label for="date_depart">Date de départ :</label>
            <input type="text" name="date_depart" id="date_depart" placeholder="Format : JJ/MM/AAAA">

            <label for="nbr_personne">Nombre de personnes :</label>
            <input type="text" name="nbr_personne" id="nbr_personne">

            <input type="submit" value="Réserver">
        </form>
    </div>

    <?php
//enregistrement
if(isset($_POST['benrg'])&&!empty($destination_id)&&!empty($date_arrive)&&!empty($date_depart)&&!empty($nbr_personne)){
$sql=mysqli_query($conn,"insert into voyage_borges(Reservation) values('$destination_id','$date_arrive','$date_depart','$nbr_personne')");
}
if($sql){
 $mess1="<b>Enregistrement éffectué avec succès !</b>";
}
else{
 $mess1="<b>Erreur !</b>";
}
?>
    <?php 
//affichage
$result = $conn->query("select * from voyage_borges ");
if($result){
    print'<div style="overflow-x:auto;">';
	print'<table border="1" id="tbfich">';
    print'<tr><th>id</th><th>pays</th></tr>';
	while($row = mysqli_fetch_assoc($result)){
	$id=$row['id'];
	$pays=$row['pays'];
	
	print'<tr>';
	print'<td>';
	     echo $id;
	print'</td>';
	
	
	print'<td>';
	     echo 	$pays;
	print'</td>';
	
	
	print'</tr>';
		}
	print'</table >';
    print'</div>';
}

$conn->close();
     ?>
</body>
</html>
