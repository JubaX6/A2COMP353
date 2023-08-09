<?php 
require_once 'database.php';

$statement = $conn->prepare('SELECT s.medicareID, s.medicareExpiryDate, s.phoneNumber, s.city, s.province, s.firstName, s.lastName, s.dateOfBirth, s.emailAddress, s.citizenship, s.postalCode, a.currentLevel FROM People s INNER JOIN Students a ON s.medicareID = a.medicareID;');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>All Students</title>
</head>

<body>
    <h1>All Students</h1>

    <table>
        <thead>
            <tr>
                <td>medicareID</td>
                <td>Medicare Expiry Date</td>
                <td>Phone Number</td>
                <td>City</td>
                <td>Province</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Birth Date</td>
                <td>emailAddress</td>
                <td>Citizenship</td>
                <td>Postal Code</td>
                <td>Current Level</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= $row["medicareID"] ?></td>
                    <td><?= $row["medicareExpiryDate"] ?></td>
                    <td><?= $row["phoneNumber"] ?></td>
                    <td><?= $row["city"] ?></td>
                    <td><?= $row["province"] ?></td>
                    <td><?= $row["firstName"] ?></td>
                    <td><?= $row["lastName"] ?></td>
                    <td><?= $row["dateOfBirth"] ?></td>
                    <td><?= $row["emailAddress"] ?></td>
                    <td><?= $row["citizenship"] ?></td>
                    <td><?= $row["postalCode"] ?></td>
                    <td><?= $row["currentLevel"] ?></td>
                    <td><a href="./editStud.php?medicareID=<?= $row["medicareID"] ?>">Edit</a></td>
                    <td><a href="./deleteStud.php?medicareID=<?= $row["medicareID"] ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="Student.php">Back to homepage</a>
</body>

</html>
