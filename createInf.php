<?php
if (
    //Ensure that all fields are full
    isset($_POST["medicareID"]) && isset($_POST["dateOfInfection"]) && isset($_POST["typeOfInfection"])
)
{
    // Insert data into table Infections

    $stmt = $conn->prepare("INSERT INTO Infections (medicareID, dateOfInfection, typeOfInfection) VALUES (:medicareID, :dateOfInfection, :typeOfInfection)");

    $stmt->bindParam(':medicareID', $_POST["medicareID"]);
    $stmt->bindParam(':dateOfInfection', $_POST["dateOfInfection"]);
    $stmt->bindParam(':typeOfInfection', $_POST["typeOfInfection"]);

    if ($stmt->execute()) {
        header("Location: .");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Infection Record</title>
</head>
<body>
    <div>
        <a href="index.php"><button>Index</button></a>
        <a href="Student.php"><button>Student</button></a>
        <a href="Employee.php"><button>Employee</button></a>
        <a href="Facility.php"><button>Facility</button></a>
        <a href="Infection.php"><button>Infection</button></a>
        <a href="Vaccination.php"><button>Vaccination</button></a>
        <a href="Registration.php"><button>Registration</button></a>
    </div>
    <h1>Create an Infection Record</h1>
    <form action="./createInf.php" method="post">
        <label for="medicareID">Medicare ID</label><br>
        <input type="text" name="medicareID" id="medicareID"><br>
        <label for="dateOfInfection">Date of Infection</label><br>
        <input type="date" name="dateOfInfection" id="dateOfInfection"><br>
        <label for="typeOfInfection">Type of Infection</label><br>
        <input type="text" name="typeOfInfection" id="typeOfInfection"><br>
        <button type="submit">Add Infection</button>
    </form>
</body>
</html>
