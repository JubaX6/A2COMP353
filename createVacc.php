<?php
if (
    //Ensures that all fields are full
    isset($_POST["medicareID"]) && isset($_POST["vaccinationDate"]) && isset($_POST["vaccinationType"]) && isset($_POST["doseNumber"])
)
{
    // Insert data into the table Vaccines

    $stmt = $conn->prepare("INSERT INTO Vaccines (medicareID, vaccinationDate, vaccinationType, doseNumber) VALUES (:medicareID, :vaccinationDate, :vaccinationType, :doseNumber)");

    $stmt->bindParam(':medicareID', $_POST["medicareID"]);
    $stmt->bindParam(':vaccinationDate', $_POST["vaccinationDate"]);
    $stmt->bindParam(':vaccinationType', $_POST["vaccinationType"]);
    $stmt->bindParam(':doseNumber', $_POST["doseNumber"]);

    if ($stmt->execute()) {
        header("Location: .");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Vaccine Record</title>
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
    <h1>Create a Vaccine Record</h1>
    <form action="./createVaccine.php" method="post">
        <label for="medicareID">Medicare ID</label><br>
        <input type="text" name="medicareID" id="medicareID"><br>
        <label for="vaccinationDate">Vaccination Date</label><br>
        <input type="date" name="vaccinationDate" id="vaccinationDate"><br>
        <label for="vaccinationType">Vaccination Type</label><br>
        <input type="text" name="vaccinationType" id="vaccinationType"><br>
        <label for="doseNumber">Dose Number</label><br>
        <input type="text" name="doseNumber" id="doseNumber"><br>
        <button type="submit">Add Vaccine</button>
    </form>
</body>
</html>
