<?php 
require_once '../database.php';

$statement = $conn->prepare('SELECT scheduleID, facilityID, employeeID, date, startTime, endTime FROM Schedule;');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Schedules</title>
</head>

<body>
    <h1>All Schedules</h1>

    <table>
        <thead>
            <tr>
                <td>Schedule ID</td>
                <td>Facility ID</td>
                <td>Employee ID</td>
                <td>Date</td>
                <td>Start Time</td>
                <td>End Time</td>
                <td>Edit</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= $row["scheduleID"] ?></td>
                    <td><?= $row["facilityID"] ?></td>
                    <td><?= $row["employeeID"] ?></td>
                    <td><?= $row["date"] ?></td>
                    <td><?= $row["startTime"] ?></td>
                    <td><?= $row["endTime"] ?></td>
                    <td><a href="./editSched.php?scheduleID=<?= $row["scheduleID"] ?>">Edit</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>
