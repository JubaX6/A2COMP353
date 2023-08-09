<?php 
require_once 'database.php';

// Check if the necessary parameters are provided
if (isset($_GET["vaccineID"]) && isset($_GET["medicareID"]) && isset($_GET["vaccinationDate"]) && isset($_GET["vaccinationType"]) && isset($_GET["doseNumber"])) {
    $vaccineID = $_GET["vaccineID"];
    $medicareID = $_GET["medicareID"];
    $vaccinationDate = $_GET["vaccinationDate"];
    $vaccinationType = $_GET["vaccinationType"];
    $doseNumber = $_GET["doseNumber"];

    // Fetch vaccine information for the provided vaccineID
    $statement = $conn->prepare('SELECT vaccineID, medicareID, vaccinationDate, vaccinationType, doseNumber FROM Vaccines WHERE vaccineID = :vaccineID;');
    $statement->bindParam(':vaccineID', $vaccineID);
    $statement->execute();
    
    $vaccine = $statement->fetch(PDO::FETCH_ASSOC);
    
    if (!$vaccine) {
        echo "Vaccine not found.";
        exit();
    }
} else {
    echo "Vaccine information not provided.";
    exit();
}

// Assign data to variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newVaccinationDate = $_POST["vaccinationDate"];
    $newVaccinationType = $_POST["vaccinationType"];
    $newDoseNumber = $_POST["doseNumber"];
    
    // Update vaccine information
    $updateStatement = $conn->prepare('UPDATE Vaccines 
                                       SET vaccinationDate = :vaccinationDate, vaccinationType = :vaccinationType, doseNumber = :doseNumber 
                                       WHERE vaccineID = :vaccineID;');
    $updateStatement->bindParam(':vaccinationDate', $newVaccinationDate);
    $updateStatement->bindParam(':vaccinationType', $newVaccinationType);
    $updateStatement->bindParam(':doseNumber', $newDoseNumber);
    $updateStatement->bindParam(':vaccineID', $vaccineID);
    $updateStatement->execute();
    
    header("Location: ./displayVacc.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Edit Vaccine</title>
</head>

<body>
    <h1>Edit Vaccine</h1>

    <form action="./editVacc.php?vaccineID=<?= $vaccineID ?>&medicareID=<?= $medicareID ?>&vaccinationDate=<?= $vaccinationDate ?>&vaccinationType=<?= $vaccinationType ?>&doseNumber=<?= $doseNumber ?>" method="post">
        <label for="vaccinationDate">Vaccination Date</label><br>
        <input type="date" name="vaccinationDate" id="vaccinationDate" value="<?= $vaccine["vaccinationDate"] ?>"><br>
        <label for="vaccinationType">Vaccination Type</label><br>
        <input type="text" name="vaccinationType" id="vaccinationType" value="<?= $vaccine["vaccinationType"] ?>"><br>
        <label for="doseNumber">Dose Number</label><br>
        <input type="number" name="doseNumber" id="doseNumber" value="<?= $vaccine["doseNumber"] ?>"><br>

        <button type="submit">Save Changes</button>
    </form>

    <a href="./displayVacc.php">Cancel</a>
</body>

</html>
