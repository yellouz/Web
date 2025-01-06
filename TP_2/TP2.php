<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <fieldset>
        <legend>Ajouter un exercice</legend>
        <form method="POST">
            Titre de l'exercice
            <input type="text" name="titre"> <br>
            Auteur de l'exercice
            <input type="text" name="auteur"> <br>
            Date creation
            <input type="date" name="date"> <br>
            
            <input type="submit" value="Envoyer" name="Envoyer">
        </form>
    </fieldset>
</body>
</html>

<?php
    $pdo = new PDO("mysql:host=localhost;dbname=tp", "root", "");

    if(isset($_POST['Envoyer']))
    {
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $date = $_POST['date'];

        $sql = "INSERT INTO exercice1 (titre, auteur, date) VALUES ('$titre', '$auteur', '$date')";

        $pdo->exec($sql);

        echo "Data successfully inserted!";
    }
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $sql = "DELETE FROM exercice1 WHERE id = $delete_id";
        $pdo->exec($sql);
        echo "Data successfully deleted!";
    }
    
    if (isset($_POST['modify_id'])) {
        $modify_id = $_POST['modify_id'];
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $date = $_POST['date'];
    
        $sql = "UPDATE exercice1 SET titre='$titre', auteur='$auteur', date='$date' WHERE id = $modify_id";
        $pdo->exec($sql);
        echo "Data successfully modified!";
    }

    $sql= 'SELECT * FROM exercice1';
    $result = $pdo->query($sql);

    echo "<br>";
    echo "<table border='1' width=75%>";

    echo "<tr><th>ID</th><th>Titre</th><th>Auteur</th><th>Date</th></tr>";

    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['titre'] . "</td>";
        echo "<td>" . $row['auteur'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
    
        echo "<td>";
        echo "<form method='POST' style='display:inline;'>";
        echo "<input type='hidden' name='modify_id' value='" . $row['id'] . "'>";
        echo "<input type='text' name='titre' value='" . $row['titre'] . "'>";
        echo "<input type='text' name='auteur' value='" . $row['auteur'] . "'>";
        echo "<input type='date' name='date' value='" . $row['date'] . "'>";
        echo "<input type='submit' value='Edit'>";
        echo "</form>";
        echo "</td>";
    
        echo "<td>";
        echo "<a href='?delete_id=" . $row['id'] . "'>Delete</a>";
        echo "</td>";
    
        echo "</tr>";
    }
    
    echo "</table>";
    ?>
