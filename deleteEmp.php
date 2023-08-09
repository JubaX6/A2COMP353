<?php
require_once 'database.php';
//Ensures that there is a medicareID to be able to delete the right Employee
if (isset($_GET["medicareID"])) {
    $medicareID = $_GET["medicareID"];

    // Delete the employee record based on the provided medicareID
    $deleteStatement = $conn->prepare('DELETE FROM Employees WHERE medicareID = :medicareID;');
    $deleteStatement->bindParam(':medicareID', $medicareID);
    $deleteStatement->execute();

    //Delete from the People Table
    $deletePersonStatement = $conn->prepare('DELETE FROM People WHERE medicareID = :medicareID;');
    $deletePersonStatement->bindParam(':medicareID', $medicareID);
    $deletePersonStatement->execute();

    header("Location: ./displayEmp.php");
} else {
    echo "Medicare ID not provided.";
}
?>
