<?php
require_once 'database.php';

$statement = $conn->prepare('SELECT s.scheduleID, s.facilityID, p.firstName AS employeeFirstName, p.lastName AS employeeLastName, s.date, s.startTime, s.endTime 
                            FROM Schedule s
                            INNER JOIN People p ON s.employeeID = p.medicareID;');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>Schedule Information</title>
</head>

<body>
    <h1>Schedule Information</h1>

    <table>
        <thead>
            <tr>
                <td>Schedule ID</td>
                <td>Facility ID</td>
                <td>Employee Name</td>
                <td>Date</td>
                <td>Start Time</td>
                <td>End Time</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= $row["scheduleID"] ?></td>
                    <td><?= $row["facilityID"] ?></td>
                    <td><?= $row["employeeFirstName"] . ' ' . $row["employeeLastName"] ?></td>
                    <td><?= $row["date"] ?></td>
                    <td><?= $row["startTime"] ?></td>
                    <td><?= $row["endTime"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="createSched.php">Add to schedule</a>
    <a href="Employee.php">Back to homepage</a>
</body>

</html>
