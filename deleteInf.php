<?php
require_once 'database.php';
//Ensures that both the medicareID and the dateOfInfection are present to delete the right infection
if (isset($_GET["medicareID"]) && isset($_GET["dateOfInfection"])) {
    $medicareID = $_GET["medicareID"];
    $dateOfInfection = $_GET["dateOfInfection"];

    // Delete the infection record
    $deleteStatement = $conn->prepare('DELETE FROM Infections WHERE medicareID = :medicareID AND dateOfInfection = :dateOfInfection;');
    $deleteStatement->bindParam(':medicareID', $medicareID);
    $deleteStatement->bindParam(':dateOfInfection', $dateOfInfection);
    $deleteStatement->execute();

    header("Location: ./displayInf.php");
} else {
    echo "Medicare ID or Date of Infection not provided.";
}
?>
