<?php 
require_once '../database.php';

// Check if the required parameters are provided
if (isset($_GET["medicareID"]) && isset($_GET["dateOfInfection"])) {
    $medicareID = $_GET["medicareID"];
    $dateOfInfection = $_GET["dateOfInfection"];

    // Fetch infection information for the provided medicareID and dateOfInfection
    $statement = $conn->prepare('SELECT medicareID, dateOfInfection, typeOfInfection FROM Infections WHERE medicareID = :medicareID AND dateOfInfection = :dateOfInfection;');
    $statement->bindParam(':medicareID', $medicareID);
    $statement->bindParam(':dateOfInfection', $dateOfInfection);
    $statement->execute();
    
    $infection = $statement->fetch(PDO::FETCH_ASSOC);
    
    if (!$infection) {
        echo "Infection not found.";
        exit();
    }
} else {
    echo "Medicare ID and Date of Infection not provided.";
    exit();
}

// Handle form submission for updating infection information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newTypeOfInfection = $_POST["typeOfInfection"];
    
    // Update infection's typeOfInfection
    $updateStatement = $conn->prepare('UPDATE Infections SET typeOfInfection = :typeOfInfection WHERE medicareID = :medicareID AND dateOfInfection = :dateOfInfection;');
    $updateStatement->bindParam(':typeOfInfection', $newTypeOfInfection);
    $updateStatement->bindParam(':medicareID', $medicareID);
    $updateStatement->bindParam(':dateOfInfection', $dateOfInfection);
    $updateStatement->execute();
    
    header("Location: ./displayInfections.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Infection</title>
</head>

<body>
    <h1>Edit Infection</h1>

    <form action="./editInf.php?medicareID=<?= $medicareID ?>&dateOfInfection=<?= $dateOfInfection ?>" method="post">
        <label for="typeOfInfection">Type of Infection</label><br>
        <input type="text" name="typeOfInfection" id="typeOfInfection" value="<?= $infection["typeOfInfection"] ?>"><br>
        
        <button type="submit">Save Changes</button>
    </form>

    <a href="./displayInf.php">Cancel</a>
</body>

</html>
