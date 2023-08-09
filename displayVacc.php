<?php 
require_once 'database.php';

$statement = $conn->prepare('SELECT medicareID, vaccinationDate, vaccinationType, doseNumber FROM Vaccines;');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
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
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= $row["medicareID"] ?></td>
                    <td><?= $row["vaccinationDate"] ?></td>
                    <td><?= $row["vaccinationType"] ?></td>
                    <td><?= $row["doseNumber"] ?></td>
                    <td><a href="editVacc.php?medicareID=<?= urlencode($row['medicareID']) ?>&vaccinationDate=<?= urlencode($row['vaccinationDate']) ?>&vaccinationType=<?= urlencode($row['vaccinationType']) ?>&doseNumber=<?= urlencode($row['doseNumber']) ?>">Edit</a></td>
                    <td><a href="deleteVacc.php?medicareID=<?= urlencode($row['medicareID']) ?>&vaccinationDate=<?= urlencode($row['vaccinationDate']) ?>&vaccinationType=<?= urlencode($row['vaccinationType']) ?>&doseNumber=<?= urlencode($row['doseNumber']) ?>">Delete</a></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="Vaccination.php">Back to homepage</a>
</body>

</html>
