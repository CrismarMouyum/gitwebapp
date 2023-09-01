<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
</head>
<body>
    <h1>Contact Us</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];
        
        // Validate and sanitize data (add more robust validation in a real application)
        $name = htmlspecialchars($name);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : "";
        $message = htmlspecialchars($message);
        
        // Insert data into the database
        if (!empty($name) && !empty($email) && !empty($message)) {
            $host = "your_database_host";
            $username = "your_database_username";
            $password = "your_database_password";
            $dbname = "your_database_name";
            
            $conn = new mysqli($host, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "INSERT INTO contact_submissions (name, email, message) VALUES ('$name', '$email', '$message')";
            if ($conn->query($sql) === TRUE) {
                echo "Submission successful!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            $conn->close();
        } else {
            echo "Please fill out all fields.";
        }
    }
    ?>
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <label for="message">Message:</label>
        <textarea name="message" required></textarea><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
