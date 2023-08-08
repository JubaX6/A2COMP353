<?php 
require_once '../database.php';

$statement = $conn->prepare('SELECT s.medID, s.medExpDate, s.phoneNumber, s.city, s.province, s.firstName, s.lastName, s.birthDate, s.email, s.citizenship, s.postalCode, s.currentLevel, a.facilityID FROM Student s INNER JOIN Attends a ON s.medID = a.medID;');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <td>Email</td>
                <td>Citizenship</td>
                <td>Postal Code</td>
                <td>Current Level</td>
                <td>Facility ID</td>
                <td>Edit</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= $row["medID"] ?></td>
                    <td><?= $row["medExpDate"] ?></td>
                    <td><?= $row["phoneNumber"] ?></td>
                    <td><?= $row["city"] ?></td>
                    <td><?= $row["province"] ?></td>
                    <td><?= $row["firstName"] ?></td>
                    <td><?= $row["lastName"] ?></td>
                    <td><?= $row["birthDate"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["citizenship"] ?></td>
                    <td><?= $row["postalCode"] ?></td>
                    <td><?= $row["currentLevel"] ?></td>
                    <td><?= $row["facilityID"] ?></td>
                    <td><a href="./editStud.php?medID=<?= $row["medID"] ?>">Edit</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>
