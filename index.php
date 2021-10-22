<?php
require_once 'connec.php';


$pdo = new \PDO(DSN, USER, PASS);

if ($_SERVER['REQUEST_METHOD'] === "POST"){
$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);

$query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
$statement = $pdo->prepare($query);

$statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
$statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

$statement->execute();
}

$statement = $pdo->query("SELECT * FROM friend");
$friends = $statement->fetchAll();

// $query = "INSERT INTO friend (firstname, lastname) VALUES ('Chandler', 'Bing')";
// $statement = $pdo->exec($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php 
        foreach($friends as $friend){
            echo "<li>" . $friend['firstname'] . ' ' . $friend['lastname'] . "</li>" ;
        }
        ?>
    </ul>

    <form action= "" method="POST">
        <label for="firstname">Prénom :</label>
        <input type = "text" id= "firstname" name = "firstname"></input>
        <br>
        <label for="lastname">Nom :</label>
        <input type = "text" id = "lastname" name = "lastname"></input>
        
        <input type="submit" value= "Ajouter un ami"></input>
    </form>
    
</body>
</html>