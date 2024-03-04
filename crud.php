<?php
// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$database = "dbname";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// CREATE operation
if(isset($_POST['create'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// READ operation
$sql = "SELECT id, name, email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Email: " . $row["email"]. "<br>";
    }
} else {
    echo "0 results";
}

// UPDATE operation
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// DELETE operation
if(isset($_POST['delete'])){
    $id = $_POST['id'];
    
    $sql = "DELETE FROM users WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Example</title>
</head>
<body>
    <h2>Create User</h2>
    <form method="post">
        <label>Name:</label><br>
        <input type="text" name="name"><br>
        <label>Email:</label><br>
        <input type="text" name="email"><br>
        <input type="submit" name="create" value="Create">
    </form>

    <h2>Update User</h2>
    <form method="post">
        <label>ID:</label><br>
        <input type="text" name="id"><br>
        <label>Name:</label><br>
        <input type="text" name="name"><br>
        <label>Email:</label><br>
        <input type="text" name="email"><br>
        <input type="submit" name="update" value="Update">
    </form>

    <h2>Delete User</h2>
    <form method="post">
        <label>ID:</label><br>
        <input type="text" name="id"><br>
        <input type="submit" name="delete" value="Delete">
    </form>
</body>
</html>
