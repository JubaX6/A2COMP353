<?php 
require_once '../database.php';

$statement = $conn->prepare('SELECT medicareID, vaccinationDate, vaccinationType, doseNumber FROM Vaccines;');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Vaccines</title>
</head>

<body>
    <h1>All Vaccines</h1>

    <table>
        <thead>
            <tr>
                <td>Medicare ID</td>
                <td>Vaccination Date</td>
                <td>Vaccination Type</td>
                <td>Dose Number</td>
                <td>Edit</td> <!-- Add a new column for the Edit button -->
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= $row["medicareID"] ?></td>
                    <td><?= $row["vaccinationDate"] ?></td>
                    <td><?= $row["vaccinationType"] ?></td>
                    <td><?= $row["doseNumber"] ?></td>
                    <td><a href="editVacc.php?medicareID=<?= $row['medicareID'] ?>">Edit</a></td> <!-- Add Edit button with medicareID parameter -->
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>
