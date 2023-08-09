<?php
require_once 'database.php';
//Ensures that there is a vaccineID, a medicareID, a vaccinationDate, a vaccinationType to delete the right vaccine
if (isset($_GET["vaccineID"]) && isset($_GET["medicareID"]) && isset($_GET["vaccinationDate"]) && isset($_GET["vaccinationType"]) && isset($_GET["doseNumber"])) {
    $vaccineID = $_GET["vaccineID"];
    $medicareID = $_GET["medicareID"];
    $vaccinationDate = $_GET["vaccinationDate"];
    $vaccinationType = $_GET["vaccinationType"];
    $doseNumber = $_GET["doseNumber"];

    // Delete the vaccine record
    $deleteStatement = $conn->prepare('DELETE FROM Vaccines WHERE vaccineID = :vaccineID AND medicareID = :medicareID AND vaccinationDate = :vaccinationDate AND vaccinationType = :vaccinationType AND doseNumber = :doseNumber;');
    $deleteStatement->bindParam(':vaccineID', $vaccineID);
    $deleteStatement->bindParam(':medicareID', $medicareID);
    $deleteStatement->bindParam(':vaccinationDate', $vaccinationDate);
    $deleteStatement->bindParam(':vaccinationType', $vaccinationType);
    $deleteStatement->bindParam(':doseNumber', $doseNumber);
    $deleteStatement->execute();

    header("Location: ./displayVacc.php");
} else {
    echo "Vaccine information not provided.";
}
?>
