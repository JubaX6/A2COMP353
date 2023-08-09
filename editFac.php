<?php 
require_once 'database.php';

// Check if the facilityID is provided
if (isset($_GET["facilityID"])) {
    $facilityID = $_GET["facilityID"];

    // Fetch facility information for the provided facilityID
    $statement = $conn->prepare('SELECT * FROM Facilities WHERE facilityID = :facilityID;');
    $statement->bindParam(':facilityID', $facilityID);
    $statement->execute();
    
    $facility = $statement->fetch(PDO::FETCH_ASSOC);
    
    if (!$facility) {
        echo "Facility not found.";
        exit();
    }
} else {
    echo "Facility ID not provided.";
    exit();
}

// Assign the information to the variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ministryID = $_POST["ministryID"];
    $facilityName = $_POST["facilityName"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $province = $_POST["province"];
    $capacity = $_POST["capacity"];
    $webAddress = $_POST["webAddress"];
    $phoneNumber = $_POST["phoneNumber"];
    $postalCode = $_POST["postalCode"];
    
    // Update facility information
    $updateFacStatement = $conn->prepare('UPDATE Facilities 
                                          SET ministryID = :ministryID, facilityName = :facilityName, address = :address, city = :city, province = :province, capacity = :capacity, 
                                              webAddress = :webAddress, phoneNumber = :phoneNumber, postalCode = :postalCode 
                                          WHERE facilityID = :facilityID;');
    $updateFacStatement->bindParam(':ministryID', $ministryID);
    $updateFacStatement->bindParam(':facilityName', $facilityName);
    $updateFacStatement->bindParam(':address', $address);
    $updateFacStatement->bindParam(':city', $city);
    $updateFacStatement->bindParam(':province', $province);
    $updateFacStatement->bindParam(':capacity', $capacity);
    $updateFacStatement->bindParam(':webAddress', $webAddress);
    $updateFacStatement->bindParam(':phoneNumber', $phoneNumber);
    $updateFacStatement->bindParam(':postalCode', $postalCode);
    $updateFacStatement->bindParam(':facilityID', $facilityID);
    $updateFacStatement->execute();
    
    header("Location: ./displayFacilities.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Edit Facility</title>
</head>

<body>
    <h1>Edit Facility</h1>

    <form action="./editFac.php?facilityID=<?= $facilityID ?>" method="post">
        <label for="ministryID">Ministry ID</label><br>
        <input type="text" name="ministryID" id="ministryID" value="<?= $facility["ministryID"] ?>"><br>
        <label for="facilityName">Facility Name</label><br>
        <input type="text" name="facilityName" id="facilityName" value="<?= $facility["facilityName"] ?>"><br>
        <label for="address">Address</label><br>
        <input type="text" name="address" id="address" value="<?= $facility["address"] ?>"><br>
        <label for="city">City</label><br>
        <input type="text" name="city" id="city" value="<?= $facility["city"] ?>"><br>
        <label for="province">Province</label><br>
        <input type="text" name="province" id="province" value="<?= $facility["province"] ?>"><br>
        <label for="capacity">Capacity</label><br>
        <input type="text" name="capacity" id="capacity" value="<?= $facility["capacity"] ?>"><br>
        <label for="webAddress">Web Address</label><br>
        <input type="text" name="webAddress" id="webAddress" value="<?= $facility["webAddress"] ?>"><br>
        <label for="phoneNumber">Phone Number</label><br>
        <input type="text" name="phoneNumber" id="phoneNumber" value="<?= $facility["phoneNumber"] ?>"><br>
        <label for="postalCode">Postal Code</label><br>
        <input type="text" name="postalCode" id="postalCode" value="<?= $facility["postalCode"] ?>"><br>

        <button type="submit">Save Changes</button>
    </form>

    <a href="./displayFac.php">Cancel</a>
</body>

</html>
