<!DOCTYPE html>
<html>
<head>
    <title>Email Log</title>
</head>
<body>
    <h1>Email Log</h1>

    <?php
    require_once 'database.php';

    // Retrieve email log records from the database
    $query = "SELECT emailID, emailDate, senderFacilityID, receiverID, emailSubject, SUBSTRING(emailBody, 1, 80) AS shortEmailBody
              FROM EmailLog
              ORDER BY emailDate DESC";
    
    $statement = $conn->query($query);
    
    if ($statement) {
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
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
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
    <a href="email.php"><button>Go back</button></a>
        <?php
    } else {
        echo "Error executing query: " . implode(" ", $conn->errorInfo());
    }
    
    // Close the database connection
    $conn = null;
    ?>
    
</body>
</html>
