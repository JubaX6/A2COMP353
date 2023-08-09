<?php
require_once 'database.php';
//Ensures that there is a facilityID to be able to delete the right one
if (isset($_GET["facilityID"])) {
    $facilityID = $_GET["facilityID"];

    // Delete the facility record based on the provided facilityID
    $deleteStatement = $conn->prepare('DELETE FROM Facilities WHERE facilityID = :facilityID;');
    $deleteStatement->bindParam(':facilityID', $facilityID);
    $deleteStatement->execute();

    header("Location: ./displayFac.php");
} else {
    echo "Facility ID not provided.";
}
?>
