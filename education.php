<?php
include 'db_config.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $course = trim($_POST['course']);

    if ($name !== "" && $email !== "" && $course !== "") {
        $stmt = $conn->prepare("INSERT INTO registrations (name, email, course_name) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $course);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>Registration successful!</p>";
        } else {
            echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p style='color:red;'>Please fill in all fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Educational Website</title>
</head>
<body>
    <h2>Student Registration Form</h2>
    <form method="POST" action="">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Course Name:</label><br>
        <input type="text" name="course" required><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
