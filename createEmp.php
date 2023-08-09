<?php 
require_once 'database.php';

//If statement to ensure that all rows are filled before updating the db
 if (

    isset($_POST["medicareID"]) && isset($_POST["medicareExpiryDate"]) && isset($_POST["phoneNumber"])
    && isset($_POST["city"]) && isset($_POST["province"]) && isset($_POST["firstName"])
    && isset($_POST["lastName"]) && isset($_POST["birthDate"]) && isset($_POST["email"])
    && isset($_POST["citizenship"]) && isset($_POST["postalCode"]) && isset($_POST["position"]) && isset($_POST['facultyID'])
){
    //Sql statement to insert into People first
 
 $stmtPeople = $conn->prepare("INSERT INTO People (medicareID, medicareExpiryDate, phoneNumber, city, province, firstName, lastName, birthDate, email, citizenship, postalCode) VALUES (:medicareID, :medicareExpiryDate, :phoneNumber, :city, :province, :firstName, :lastName, :birthDate, :email, :citizenship, :postalCode)");

 $stmtPeople->bindParam(':medicareID', $_POST["medicareID"]);
 $stmtPeople->bindParam(':medicareExpiryDate', $_POST["medicareExpiryDate"]);
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

 //Insert in the Employee Table after
 if ($peopleInserted) {
    $stmtEmployee = $conn->prepare("INSERT INTO Employees (medicareID,position,facultyID) VALUES (:medicareID, :position, :facultyID)");

    $stmtEmployee->bindParam(':position', $_POST["position"]);
    $stmtEmployee->bindParam(':medicareID', $_POST["medicareID"]);
    $stmtEmployee->bindParam(':facultyID', $_POST["facultyID"]);
   

    if ($stmtEmployee->execute()) {
        header("Location: .");
    }


   
}
}

?>
<!DOCTYPE html>

<html lang="en">

<head>
    
    <title>createEmployee</title>
</head>


<body>
<th><a href="index.php"><button >Index</button></a></th>
<th><a href="Student.php"> <button >Student</button></a></th>
    <th><a href="Employee.php"> <button >Employee</button></a></th>
    <th><a href="Facility.php"><button >Facility</button></a></th>
    <th><a href="Infection.php"><button >Infection</button></a></th>
    <th><a href="Vaccination.php"><button >Vaccination</button></a></th>
    <th><a href="Registration.php"><button >Registration</button></a></th>
    <th><a href="email.php"><button >Email</button></a></th>
    <h1>Create an Employee</h1>
    <form action="./createEmp.php" method="post">
        <label for="medicareID">medicareID</label><br>
        <input type='text' name="medicareID" id="medicareID"> <br>
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