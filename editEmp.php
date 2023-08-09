<?php 
require_once 'database.php';

// Check if the medicareID is provided
if (isset($_GET["medicareID"])) {
    $medicareID = $_GET["medicareID"];

    // Fetch employee and people information for the provided medicareID
    $statement = $conn->prepare('SELECT E.medicareID, E.position, P.medicareExpiryDate, P.phoneNumber, P.address, P.city, P.province, P.firstName, P.lastName, P.dateOfBirth, P.emailAddress, P.citizenship, P.postalCode 
                                FROM Employees AS E
                                INNER JOIN People AS P ON E.medicareID = P.medicareID
                                WHERE E.medicareID = :medicareID;');
    $statement->bindParam(':medicareID', $medicareID);
    $statement->execute();
    
    $employee = $statement->fetch(PDO::FETCH_ASSOC);
    
    if (!$employee) {
        echo "Employee not found.";
        exit();
    }
} else {
    echo "Medicare ID not provided.";
    exit();
}

// Assigns the values to variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $position = $_POST["position"];
    $medicareExpiryDate = $_POST["medicareExpiryDate"];
    $phoneNumber = $_POST["phoneNumber"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $province = $_POST["province"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $dateOfBirth = $_POST["dateOfBirth"];
    $emailAddress = $_POST["emailAddress"];
    $citizenship = $_POST["citizenship"];
    $postalCode = $_POST["postalCode"];
    
    // Update employee's position
    $updateEmpStatement = $conn->prepare('UPDATE Employees SET position = :position WHERE medicareID = :medicareID;');
    $updateEmpStatement->bindParam(':position', $position);
    $updateEmpStatement->bindParam(':medicareID', $medicareID);
    $updateEmpStatement->execute();
    
    // Update people's information
    $updatePeopleStatement = $conn->prepare('UPDATE People 
                                              SET medicareExpiryDate = :medicareExpiryDate, phoneNumber = :phoneNumber, address = :address, city = :city, province = :province, 
                                                  firstName = :firstName, lastName = :lastName, dateOfBirth = :dateOfBirth, emailAddress = :emailAddress, citizenship = :citizenship, postalCode = :postalCode 
                                              WHERE medicareID = :medicareID;');
    $updatePeopleStatement->bindParam(':medicareExpiryDate', $medicareExpiryDate);
    $updatePeopleStatement->bindParam(':phoneNumber', $phoneNumber);
    $updatePeopleStatement->bindParam(':address', $address);
    $updatePeopleStatement->bindParam(':city', $city);
    $updatePeopleStatement->bindParam(':province', $province);
    $updatePeopleStatement->bindParam(':firstName', $firstName);
    $updatePeopleStatement->bindParam(':lastName', $lastName);
    $updatePeopleStatement->bindParam(':dateOfBirth', $dateOfBirth);
    $updatePeopleStatement->bindParam(':emailAddress', $emailAddress);
    $updatePeopleStatement->bindParam(':citizenship', $citizenship);
    $updatePeopleStatement->bindParam(':postalCode', $postalCode);
    $updatePeopleStatement->bindParam(':medicareID', $medicareID);
    $updatePeopleStatement->execute();
    
    header("Location: ./displayEmployees.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Edit Employee</title>
</head>

<body>
    <h1>Edit Employee</h1>

    <form action="./editEmp.php?medicareID=<?= $medicareID ?>" method="post">
        <label for="position">Position</label><br>
        <input type="text" name="position" id="position" value="<?= $employee["position"] ?>"><br>
        <label for="medicareExpiryDate">Medicare Expiry Date</label><br>
        <input type="text" name="medicareExpiryDate" id="medicareExpiryDate" value="<?= $employee["medicareExpiryDate"] ?>"><br>
        <label for="phoneNumber">Phone Number</label><br>
        <input type="text" name="phoneNumber" id="phoneNumber" value="<?= $employee["phoneNumber"] ?>"><br>
        <label for="address">Address</label><br>
        <input type="text" name="address" id="address" value="<?= $employee["address"] ?>"><br>
        <label for="city">City</label><br>
        <input type="text" name="city" id="city" value="<?= $employee["city"] ?>"><br>
        <label for="province">Province</label><br>
        <input type="text" name="province" id="province" value="<?= $employee["province"] ?>"><br>
        <label for="firstName">First Name</label><br>
        <input type="text" name="firstName" id="firstName" value="<?= $employee["firstName"] ?>"><br>
        <label for="lastName">Last Name</label><br>
        <input type="text" name="lastName" id="lastName" value="<?= $employee["lastName"] ?>"><br>
        <label for="dateOfBirth">Date of Birth</label><br>
        <input type="text" name="dateOfBirth" id="dateOfBirth" value="<?= $employee["dateOfBirth"] ?>"><br>
        <label for="emailAddress">Email Address</label><br>
        <input type="text" name="emailAddress" id="emailAddress" value="<?= $employee["emailAddress"] ?>"><br>
        <label for="citizenship">Citizenship</label><br>
        <input type="text" name="citizenship" id="citizenship" value="<?= $employee["citizenship"] ?>"><br>
        <label for="postalCode">Postal Code</label><br>
        <input type="text" name="postalCode" id="postalCode" value="<?= $employee["postalCode"] ?>"><br>
        
        <button type="submit">Save Changes</button>
    </form>

    <a href="./displayEmployees.php">Cancel</a>
</body>

</html>
