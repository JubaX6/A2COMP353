<?php 
require_once 'database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $facilityID = $_POST["facilityID"];
    $employeeID = $_POST["employeeID"];
    $date = $_POST["date"];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];
    
    // Insert new schedule into the database
    $insertStatement = $conn->prepare('INSERT INTO Schedule (facilityID, employeeID, date, startTime, endTime) 
                                       VALUES (:facilityID, :employeeID, :date, :startTime, :endTime);');
    $insertStatement->bindParam(':facilityID', $facilityID);
    $insertStatement->bindParam(':employeeID', $employeeID);
    $insertStatement->bindParam(':date', $date);
    $insertStatement->bindParam(':startTime', $startTime);
    $insertStatement->bindParam(':endTime', $endTime);
    $insertStatement->execute();
    
    header("Location: ./displaySched.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Create Schedule</title>
</head>

<body>
    <h1>Create Schedule</h1>

    <form action="./createSched.php" method="post">
        <label for="facilityID">Facility ID</label><br>
        <input type="text" name="facilityID" id="facilityID"><br>
        <label for="employeeID">Employee ID</label><br>
        <input type="text" name="employeeID" id="employeeID"><br>
        <label for="date">Date</label><br>
        <input type="text" name="date" id="date"><br>
        <label for="startTime">Start Time</label><br>
        <input type="text" name="startTime" id="startTime"><br>
        <label for="endTime">End Time</label><br>
        <input type="text" name="endTime" id="endTime"><br>
        
        <button type="submit">Create Schedule</button>
    </form>

    <a href="./displaySched.php">Cancel</a>
</body>

</html>
