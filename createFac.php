<?php
if (
    //Make sure that every field is full
    isset($_POST["facilityID"]) && isset($_POST["ministryID"]) && isset($_POST["facilityName"])
    && isset($_POST["address"]) && isset($_POST["city"]) && isset($_POST["province"])
    && isset($_POST["capacity"]) && isset($_POST["webAddress"]) && isset($_POST["phoneNumber"])
    && isset($_POST["postalCode"])
)
{
    // Insert into Facilities table

    $stmt = $conn->prepare("INSERT INTO Facilities (facilityID, ministryID, facilityName, address, city, province, capacity, webAddress, phoneNumber, postalCode) VALUES (:facilityID, :ministryID, :facilityName, :address, :city, :province, :capacity, :webAddress, :phoneNumber, :postalCode)");

    $stmt->bindParam(':facilityID', $_POST["facilityID"]);
    $stmt->bindParam(':ministryID', $_POST["ministryID"]);
    $stmt->bindParam(':facilityName', $_POST["facilityName"]);
    $stmt->bindParam(':address', $_POST["address"]);
    $stmt->bindParam(':city', $_POST["city"]);
    $stmt->bindParam(':province', $_POST["province"]);
    $stmt->bindParam(':capacity', $_POST["capacity"]);
    $stmt->bindParam(':webAddress', $_POST["webAddress"]);
    $stmt->bindParam(':phoneNumber', $_POST["phoneNumber"]);
    $stmt->bindParam(':postalCode', $_POST["postalCode"]);

    if ($stmt->execute()) {
        header("Location: .");
    }}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Facility</title>
</head>
<body>
<th><a href="index.php"><button >Index</button></a></th>
    <th><a href="Student.php"><button >Student</button></a></th>
    <th><a href="Employee.php"><button >Employee</button></a></th>
    <th><a href="Facility.php"><button >Facility</button></a></th>
    <th><a href="Infection.php"><button >Infection</button></a></th>
    <th><a href="Vaccination.php"><button >Vaccination</button></a></th>
    <th><a href="Registration.php"><button >Registration</button></a></th>
    <th><a href="email.php"><button >Email</button></a></th>
    <h1>Create a Facility</h1>
    <form action="./createFac.php" method="post">
        <label for="facilityID">Facility ID</label><br>
        <input type='text' name="facilityID" id="facilityID"> <br>
        <label for="ministryID">Ministry ID</label><br>
        <input type='text' name="ministryID" id="ministryID"> <br>
        <label for="facilityName">Facility Name</label><br>
        <input type='text' name="facilityName" id="facilityName"> <br>
        <label for="address">Address</label><br>
        <input type='text' name="address" id="address"> <br>
        <label for="city">City</label><br>
        <input type='text' name="city" id="city"> <br>
        <label for="province">Province</label><br>
        <input type='text' name="province" id="province"> <br>
        <label for="capacity">Capacity</label><br>
        <input type='text' name="capacity" id="capacity"> <br>
        <label for="webAddress">Web Address</label><br>
        <input type='text' name="webAddress" id="webAddress"> <br>
        <label for="phoneNumber">Phone Number</label><br>
        <input type='text' name="phoneNumber" id="phoneNumber"> <br>
        <label for="postalCode">Postal Code</label><br>
        <input type='text' name="postalCode" id="postalCode"> <br>
        <button type="submit">Add Facility</button>
    </form>
</body>
</html>