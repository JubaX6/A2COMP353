<?php 
require_once '../database.php';

// Check if the medicareID is provided
if (isset($_GET["medicareID"])) {
    $medicareID = $_GET["medicareID"];

    // Fetch vaccine information for the provided medicareID
    $statement = $conn->prepare('SELECT medicareID, vaccinationDate, vaccinationType, doseNumber FROM Vaccines WHERE medicareID = :medicareID;');
    $statement->bindParam(':medicareID', $medicareID);
    $statement->execute();
    
    $vaccine = $statement->fetch(PDO::FETCH_ASSOC);
    
    if (!$vaccine) {
        echo "Vaccine not found.";
        exit();
    }
} else {
    echo "Medicare ID not provided.";
    exit();
}

// Handle form submission for updating vaccine information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vaccinationDate = $_POST["vaccinationDate"];
    $vaccinationType = $_POST["vaccinationType"];
    $doseNumber = $_POST["doseNumber"];
    
    // Update vaccine information
    $updateStatement = $conn->prepare('UPDATE Vaccines 
                                       SET vaccinationDate = :vaccinationDate, vaccinationType = :vaccinationType, doseNumber = :doseNumber 
                                       WHERE medicareID = :medicareID;');
    $updateStatement->bindParam(':vaccinationDate', $vaccinationDate);
    $updateStatement->bindParam(':vaccinationType', $vaccinationType);
    $updateStatement->bindParam(':doseNumber', $doseNumber);
    $updateStatement->bindParam(':medicareID', $medicareID);
    $updateStatement->execute();
    
    header("Location: ./displayVaccines.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vaccine</title>
</head>

<body>
    <h1>Edit Vaccine</h1>

    <form action="./editVacc.php?medicareID=<?= $medicareID ?>" method="post">
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
