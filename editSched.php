<?php 
require_once '../database.php';

// Check if the scheduleID is provided
if (isset($_GET["scheduleID"])) {
    $scheduleID = $_GET["scheduleID"];

    // Fetch schedule information for the provided scheduleID
    $statement = $conn->prepare('SELECT scheduleID, facilityID, employeeID, date, startTime, endTime FROM Schedule WHERE scheduleID = :scheduleID;');
    $statement->bindParam(':scheduleID', $scheduleID);
    $statement->execute();
    
    $schedule = $statement->fetch(PDO::FETCH_ASSOC);
    
    if (!$schedule) {
        echo "Schedule not found.";
        exit();
    }
} else {
    echo "Schedule ID not provided.";
    exit();
}

// Handle form submission for updating schedule information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $facilityID = $_POST["facilityID"];
    $employeeID = $_POST["employeeID"];
    $date = $_POST["date"];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];
    
    // Update schedule information
    $updateStatement = $conn->prepare('UPDATE Schedule 
                                       SET facilityID = :facilityID, employeeID = :employeeID, date = :date, startTime = :startTime, endTime = :endTime 
                                       WHERE scheduleID = :scheduleID;');
    $updateStatement->bindParam(':facilityID', $facilityID);
    $updateStatement->bindParam(':employeeID', $employeeID);
    $updateStatement->bindParam(':date', $date);
    $updateStatement->bindParam(':startTime', $startTime);
    $updateStatement->bindParam(':endTime', $endTime);
    $updateStatement->bindParam(':scheduleID', $scheduleID);
    $updateStatement->execute();
    
    header("Location: ./displaySchedule.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Schedule</title>
</head>

<body>
    <h1>Edit Schedule</h1>

    <form action="./editSchedule.php?scheduleID=<?= $scheduleID ?>" method="post">
        <label for="facilityID">Facility ID</label><br>
        <input type="text" name="facilityID" id="facilityID" value="<?= $schedule["facilityID"] ?>"><br>
        <label for="employeeID">Employee ID</label><br>
        <input type="text" name="employeeID" id="employeeID" value="<?= $schedule["employeeID"] ?>"><br>
        <label for="date">Date</label><br>
        <input type="text" name="date" id="date" value="<?= $schedule["date"] ?>"><br>
        <label for="startTime">Start Time</label><br>
        <input type="text" name="startTime" id="startTime" value="<?= $schedule["startTime"] ?>"><br>
        <label for="endTime">End Time</label><br>
        <input type="text" name="endTime" id="endTime" value="<?= $schedule["endTime"] ?>"><br>
        
        <button type="submit">Save Changes</button>
    </form>

    <a href="./displaySched.php">Cancel</a>
</body>

</html>
