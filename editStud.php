<?php 
require_once '../database.php';

// Check if the medID is provided
if (isset($_GET["medID"])) {
    $medID = $_GET["medID"];

    // Fetch student information for the provided medID
    $statement = $conn->prepare('SELECT medID, medExpDate, phoneNumber, city, province, firstName, lastName, birthDate, email, citizenship, postalCode, currentLevel FROM Student WHERE medID = :medID;');
    $statement->bindParam(':medID', $medID);
    $statement->execute();
    
    $student = $statement->fetch(PDO::FETCH_ASSOC);
    
    if (!$student) {
        echo "Student not found.";
        exit();
    }
} else {
    echo "MedID not provided.";
    exit();
}

// Handle form submission for updating student information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medExpDate = $_POST["medExpDate"];
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
                                       SET medExpDate = :medExpDate, phoneNumber = :phoneNumber, city = :city, province = :province, 
                                           firstName = :firstName, lastName = :lastName, birthDate = :birthDate, email = :email, 
                                           citizenship = :citizenship, postalCode = :postalCode, currentLevel = :currentLevel 
                                       WHERE medID = :medID;');
    $updateStatement->bindParam(':medExpDate', $medExpDate);
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
    $updateStatement->bindParam(':medID', $medID);
    $updateStatement->execute();
    
    header("Location: ./displayStud.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>

<body>
    <h1>Edit Student</h1>

    <form action="./editStudent.php?medID=<?= $medID ?>" method="post">
        <label for="medExpDate">Medicare Expiry Date</label><br>
        <input type="date" name="medExpDate" id="medExpDate" value="<?= $student["medExpDate"] ?>"><br>
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
