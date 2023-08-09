<?php
require_once 'database.php';
//Ensures that there is a medicareID to delete the student from
if (isset($_GET["medicareID"])) {
    $medicareID = $_GET["medicareID"];

    // Delete the student record based on the provided medicareID
    $deleteStatement = $conn->prepare('DELETE FROM Students WHERE medicareID = :medicareID;');
    $deleteStatement->bindParam(':medicareID', $medicareID);
    $deleteStatement->execute();

    header("Location: ./displayStud.php");
} else {
    echo "MedicareID not provided.";
}
?>
