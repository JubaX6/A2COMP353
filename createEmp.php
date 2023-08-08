<?php 
//require_once '../database.php';

 if (
    isset($_POST["medID"]) && isset($_POST["medExpDate"]) && isset($_POST["phoneNumber"])
    && isset($_POST["city"]) && isset($_POST["province"]) && isset($_POST["firstName"])
    && isset($_POST["lastName"]) && isset($_POST["birthDate"]) && isset($_POST["email"])
    && isset($_POST["citizenship"]) && isset($_POST["postalCode"]) && isset($_POST["position"])
){
    $stmt = $conn->prepare("INSERT INTO your_table_name (medID, medExpDate, phoneNumber, city, province, firstName, lastName, birthDate, email, citizenship, postalCode, position) VALUES (:medID, :medExpDate, :phoneNumber, :city, :province, :firstName, :lastName, :birthDate, :email, :citizenship, :postalCode, :position)");

    $stmt->bindParam(':medID', $_POST["medID"]);
    $stmt->bindParam(':medExpDate', $_POST["medExpDate"]);
    $stmt->bindParam(':phoneNumber', $_POST["phoneNumber"]);
    $stmt->bindParam(':city', $_POST["city"]);
    $stmt->bindParam(':province', $_POST["province"]);
    $stmt->bindParam(':firstName', $_POST["firstName"]);
    $stmt->bindParam(':lastName', $_POST["lastName"]);
    $stmt->bindParam(':birthDate', $_POST["birthDate"]);
    $stmt->bindParam(':email', $_POST["email"]);
    $stmt->bindParam(':citizenship', $_POST["citizenship"]);
    $stmt->bindParam(':postalCode', $_POST["postalCode"]);
    $stmt->bindParam(':position', $_POST["position"]);

    if ($stmt->execute()) {
        header("Location: .");
    }
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
    <h1>Create an Employee</h1>
    <form action="./createEmp.php" method="post">
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
        <label for="postion">Position</label><br>
        <input type='text' name="position" id="position"> <br>
        <button type="submit">Add</button>
        
    </form>
</body>

</html>