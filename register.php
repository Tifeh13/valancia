<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data

    $endpoint = 'https://example.com/api/endpoint';
    
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Validate form data
    if (empty($full_name) || empty($email) || empty($phone)) {
        echo "Please fill in all required fields.";
    }

    $servername = "localhost";
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $database = "val"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Save form data to a database
    $stmt = $conn->prepare("INSERT INTO `info` (`full_name`, `email`, `phone`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $full_name, $email, $phone);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo '<script type="text/javascript">';
    echo 'document.getElementById("registerModal").classList.remove("show");';
    echo 'document.getElementById("registerModal").setAttribute("aria-hidden", "true");';   
    echo 'document.getElementById("registerModal").style.display = "none";';
    echo 'document.querySelector(".modal-backdrop").remove();'; // Remove the backdrop if needed
    echo '</script>';
    
} else {
    // Redirect or display an error message
    header("Location: error.php");
    exit();
}
?>