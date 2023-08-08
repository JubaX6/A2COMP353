<?php 
require_once '../database.php';

$statement = $conn->prepare('SELECT facilityID, facilityName, address, city, province, capacity, webAddress, phoneNumber, postalCode FROM Facilities;');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Facilities</title>
</head>

<body>
    <h1>All Facilities</h1>

    <table>
        <thead>
            <tr>
                <td>Facility Name</td>
                <td>Address</td>
                <td>City</td>
                <td>Province</td>
                <td>Capacity</td>
                <td>Web Address</td>
                <td>Phone Number</td>
                <td>Postal Code</td>
                <td>Edit</td> <!-- Add Edit column header -->
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= $row["facilityName"] ?></td>
                    <td><?= $row["address"] ?></td>
                    <td><?= $row["city"] ?></td>
                    <td><?= $row["province"] ?></td>
                    <td><?= $row["capacity"] ?></td>
                    <td><?= $row["webAddress"] ?></td>
                    <td><?= $row["phoneNumber"] ?></td>
                    <td><?= $row["postalCode"] ?></td>
                    <td><a href="./editFac.php?facilityID=<?= $row["facilityID"] ?>">Edit</a></td> <!-- Edit button -->
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>
