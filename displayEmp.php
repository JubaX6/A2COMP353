<?php 
require_once 'database.php';

$statement = $conn->prepare('SELECT E.medicareID, E.position, P.medicareExpiryDate, P.phoneNumber, P.address, P.city, P.province, P.firstName, P.lastName, P.dateOfBirth, P.emailAddress, P.citizenship, P.postalCode 
                            FROM Employees AS E
                            INNER JOIN People AS P ON E.medicareID = P.medicareID;');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>All Employees</title>
</head>

<body>
    <h1>All Employees</h1>

    <table>
        <thead>
            <tr>
                <td>Medicare ID</td>
                <td>Position</td>
                <td>Medicare Expiry Date</td>
                <td>Phone Number</td>
                <td>Address</td>
                <td>City</td>
                <td>Province</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Date of Birth</td>
                <td>Email Address</td>
                <td>Citizenship</td>
                <td>Postal Code</td>
                <td>Edit</td>
                <td>Delete</td> 
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= $row["medicareID"] ?></td>
                    <td><?= $row["position"] ?></td>
                    <td><?= $row["medicareExpiryDate"] ?></td>
                    <td><?= $row["phoneNumber"] ?></td>
                    <td><?= $row["address"] ?></td>
                    <td><?= $row["city"] ?></td>
                    <td><?= $row["province"] ?></td>
                    <td><?= $row["firstName"] ?></td>
                    <td><?= $row["lastName"] ?></td>
                    <td><?= $row["dateOfBirth"] ?></td>
                    <td><?= $row["emailAddress"] ?></td>
                    <td><?= $row["citizenship"] ?></td>
                    <td><?= $row["postalCode"] ?></td>
                    <td><a href="./editEmp.php?medicareID=<?= $row["medicareID"] ?>">Edit</a></td>
                    <td><a href="./deleteEmp.php?medicareID=<?= $row["medicareID"] ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="Employee.php">Back to homepage</a>
</body>

</html>
