<?php 
//require_once '../database.php';

 if (
    isset($_POST["medID"]) && isset($_POST["medExpDate"]) && isset($_POST["phoneNumber"])
    && isset($_POST["city"]) && isset($_POST["province"]) && isset($_POST["firstName"])
    && isset($_POST["lastName"]) && isset($_POST["birthDate"]) && isset($_POST["email"])
    && isset($_POST["citizenship"]) && isset($_POST["postalCode"]) && isset($_POST["currentLevel"])
)try {
    // Insert into People table
    $stmtPeople = $conn->prepare("INSERT INTO People (medID, medExpDate, phoneNumber, city, province, firstName, lastName, birthDate, email, citizenship, postalCode) VALUES (:medID, :medExpDate, :phoneNumber, :city, :province, :firstName, :lastName, :birthDate, :email, :citizenship, :postalCode)");

    $stmtPeople->bindParam(':medID', $_POST["medID"]);
    $stmtPeople->bindParam(':medExpDate', $_POST["medExpDate"]);
    $stmtPeople->bindParam(':phoneNumber', $_POST["phoneNumber"]);
    $stmtPeople->bindParam(':city', $_POST["city"]);
    $stmtPeople->bindParam(':province', $_POST["province"]);
    $stmtPeople->bindParam(':firstName', $_POST["firstName"]);
    $stmtPeople->bindParam(':lastName', $_POST["lastName"]);
    $stmtPeople->bindParam(':birthDate', $_POST["birthDate"]);
    $stmtPeople->bindParam(':email', $_POST["email"]);
    $stmtPeople->bindParam(':citizenship', $_POST["citizenship"]);
    $stmtPeople->bindParam(':postalCode', $_POST["postalCode"]);

    $peopleInserted = $stmtPeople->execute();

    // Insert into Student table
    if ($peopleInserted) {
        $stmtStudent = $conn->prepare("INSERT INTO Student (currentLevel, medID, facultyID) VALUES (:currentLevel, :medID, :facultyID)");

        $stmtStudent->bindParam(':currentLevel', $_POST["currentLevel"]);
        $stmtStudent->bindParam(':medID', $_POST["medID"]);
       

        if ($stmtStudent->execute()) {
            header("Location: .");
        }
    }
} catch (PDOException $e) {
    // Handle any errors that might occur during database operations
    echo "Error: " . $e->getMessage();
}



?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>createStudent</title>
</head>


<body>
<th><a href="index.php"><button >Index</button></a></th>
<th><a href="Student.php"> <button >Student</button></a></th>
    <th><a href="Employee.php"> <button >Employee</button></a></th>
    <th><a href="Facility.php"><button >Facility</button></a></th>
    <th><a href="Infection.php"><button >Infection</button></a></th>
    <th><a href="Vaccination.php"><button >Vaccination</button></a></th>
    <th><a href="Registration.php"><button >Registration</button></a></th>
    <h1>Create a Student</h1>
    <form action="./createStud.php" method="post">
        <label for="medID">medicareID</label><br>
        <input type='text' name="medID" id="medID"> <br>
        <label for="medExpDate">Medicare Expiry Date</label><br>
        <input type='date' name="medExpDate" id="medExpDate"> <br>
        <label for="phoneNumber">Phone</label><br>
        <input type='text' name="phoneNumber" id="phoneNumber"> <br>
        <label for="city">City</label><br>
        <input type='text' name="city" id="city"> <br>
        <label for="province">Province</label><br>
        <input type='text' name="province" id="province"> <br>
        <label for="firstName">First Name</label><br>
        <input type='text' name="firstName" id="firstName"> <br>
        <label for="lastName">Last Name</label><br>
        <input type='text' name="lastName" id="lastName"> <br>
        <label for="birthDate">BirthDate</label><br>
        <input type='date' name="birthDate" id="birthDate"> <br>
        <label for="email">Email</label><br>
        <input type='text' name="email" id="email"> <br>
        <label for="citizenship">Citizenship</label><br>
        <input type='text' name="citizenship" id="citizenship"> <br>
        <label for="postalCode">Postal Code</label><br>
        <input type='text' name="postalCode" id="postalCode"> <br>
        <label for="currentLevel">CurrentLevel</label><br>
        <input type='text' name="currentLevel" id="currentLevel"> <br>
        
        <button type="submit">Add</button>
        
    </form>
</body>

</html>