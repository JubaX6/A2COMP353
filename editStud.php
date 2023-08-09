<?php 
require_once 'database.php';

// Check if the medicareID is provided
if (isset($_GET["medicareID"])) {
    $medicareID = $_GET["medicareID"];

    // Fetch student information for the provided medicareID
    $statement = $conn->prepare('SELECT medicareID, medicareExpiryDate, phoneNumber, city, province, firstName, lastName, birthDate, email, citizenship, postalCode, currentLevel FROM Students WHERE medicareID = :medicareID;');
    $statement->bindParam(':medicareID', $medicareID);
    $statement->execute();
    
    $student = $statement->fetch(PDO::FETCH_ASSOC);
    
    if (!$student) {
        echo "Student not found.";
        exit();
    }
} else {
    echo "MedicareID not provided.";
    exit();
}

// Assign information to variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medExpDate = $_POST["medicareExpiryDate"];
    $phoneNumber = $_POST["phoneNumber"];
    $city = $_POST["city"];
    $province = $_POST["province"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $birthDate = $_POST["birthDate"];
    $email = $_POST["email"];
    $citizenship = $_POST["citizenship"];
    $postalCode = $_POST["postalCode"];
    $currentLevel = $_POST["currentLevel"];
    
    // Update student information
    $updateStatement = $conn->prepare('UPDATE Student 
                                       SET medicareExpiryDate = :medicareExpiryDate, phoneNumber = :phoneNumber, city = :city, province = :province, 
                                           firstName = :firstName, lastName = :lastName, birthDate = :birthDate, email = :email, 
                                           citizenship = :citizenship, postalCode = :postalCode, currentLevel = :currentLevel 
                                       WHERE medicareID = :medicareID;');
    $updateStatement->bindParam(':medicareExpiryDate', $medicareExpiryDate);
    $updateStatement->bindParam(':phoneNumber', $phoneNumber);
    $updateStatement->bindParam(':city', $city);
    $updateStatement->bindParam(':province', $province);
    $updateStatement->bindParam(':firstName', $firstName);
    $updateStatement->bindParam(':lastName', $lastName);
    $updateStatement->bindParam(':birthDate', $birthDate);
    $updateStatement->bindParam(':email', $email);
    $updateStatement->bindParam(':citizenship', $citizenship);
    $updateStatement->bindParam(':postalCode', $postalCode);
    $updateStatement->bindParam(':currentLevel', $currentLevel);
    $updateStatement->bindParam(':medicareID', $medicareID);
    $updateStatement->execute();
    
    header("Location: ./displayStud.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Edit Student</title>
</head>

<body>
    <h1>Edit Student</h1>

    <form action="./editStudent.php?medicareID=<?= $medicareID ?>" method="post">
        <label for="medicareExpiryDate">Medicare Expiry Date</label><br>
        <input type="date" name="medicareExpiryDate" id="medicareExpiryDate" value="<?= $student["medicareExpiryDate"] ?>"><br>
        <label for="phoneNumber">Phone Number</label><br>
        <input type="text" name="phoneNumber" id="phoneNumber" value="<?= $student["phoneNumber"] ?>"><br>
        <label for="city">City</label><br>
        <input type="text" name="city" id="city" value="<?= $student["city"] ?>"><br>
        <label for="province">Province</label><br>
        <input type="text" name="province" id="province" value="<?= $student["province"] ?>"><br>
        <label for="firstName">First Name</label><br>
        <input type="text" name="firstName" id="firstName" value="<?= $student["firstName"] ?>"><br>
        <label for="lastName">Last Name</label><br>
        <input type="text" name="lastName" id="lastName" value="<?= $student["lastName"] ?>"><br>
        <label for="birthDate">Birth Date</label><br>
        <input type="date" name="birthDate" id="birthDate" value="<?= $student["birthDate"] ?>"><br>
        <label for="email">Email</label><br>
        <input type="email" name="email" id="email" value="<?= $student["email"] ?>"><br>
        <label for="citizenship">Citizenship</label><br>
        <input type="text" name="citizenship" id="citizenship" value="<?= $student["citizenship"] ?>"><br>
        <label for="postalCode">Postal Code</label><br>
        <input type="text" name="postalCode" id="postalCode" value="<?= $student["postalCode"] ?>"><br>
        <label for="currentLevel">Current Level</label><br>
        <input type="text" name="currentLevel" id="currentLevel" value="<?= $student["currentLevel"] ?>"><br>

        <button type="submit">Save Changes</button>
    </form>

    <a href="./displayStud.php">Cancel</a>
</body>

</html>
