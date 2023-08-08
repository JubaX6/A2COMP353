<!DOCTYPE html>
<html>
<head>
    <title>Email Log</title>
</head>
<body>
    <h1>Email Log</h1>

    <?php
    require_once '../database.php';
    
    // Retrieve email log records from the database
    $query = "SELECT emailID, emailDate, senderFacilityID, receiverID, emailSubject, SUBSTRING(emailBody, 1, 80) AS shortEmailBody
              FROM EmailLog
              ORDER BY emailDate DESC";
    
    $result = $connection->query($query);
    ?>

    <table>
        <tr>
            <th>Email ID</th>
            <th>Date</th>
            <th>Sender Facility ID</th>
            <th>Receiver ID</th>
            <th>Subject</th>
            <th>Body</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["emailID"] . "</td>";
            echo "<td>" . $row["emailDate"] . "</td>";
            echo "<td>" . $row["senderFacilityID"] . "</td>";
            echo "<td>" . $row["receiverID"] . "</td>";
            echo "<td>" . $row["emailSubject"] . "</td>";
            echo "<td>" . $row["shortEmailBody"] . "</td>";
            echo "</tr>";
        }
        ?>

    </table>

    <?php
    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
