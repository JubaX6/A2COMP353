<?php 
require_once 'database.php';

$statement = $conn->prepare('SELECT medicareID, dateOfInfection, typeOfInfection FROM Infections;');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>All Infections</title>
</head>

<body>
    <h1>All Infections</h1>

    <table>
        <thead>
            <tr>
                <td>Medicare ID</td>
                <td>Date of Infection</td>
                <td>Type of Infection</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= $row["medicareID"] ?></td>
                    <td><?= $row["dateOfInfection"] ?></td>
                    <td><?= $row["typeOfInfection"] ?></td>
                    <td><a href="./editInf.php?medicareID=<?= $row["medicareID"] ?>&dateOfInfection=<?= $row["dateOfInfection"] ?>">Edit</a></td>
                    <td><a href="./deleteInf.php?medicareID=<?= $row["medicareID"] ?>&dateOfInfection=<?= $row["dateOfInfection"] ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="Infection.php">Back to homepage</a>
</body>

</html>
