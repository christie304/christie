<?php
    
if(!empty($_POST['username']) && !empty($_POST['password'])) {
    // check the username and password
    if($_POST['username'] == 'emiley' && $_POST['password'] == 'p1nkm1lk1230$') {
        // set the session
        session_start();
        $_SESSION['username'] = $_POST['username'];
        
        $servername = "cranor.pdx1-mysql-a7-7b.dreamhost.com";
        $username = "athenablue_admin"; // Replace with your database username
        $password = "Lun@317$"; // Replace with your database password
        $dbname = "emileydb";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to select records
        $sql = "SELECT RsvpID, FullName, Email, NumberOfGuests FROM rsvp";
        $result = $conn->query($sql);
        //print_r($result);
        ?>
<!DOCTYPE html>
<html>
<head>
    <title>RSVP Records</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>RSVP Records</h2>

<table>
    <tr>
        <th>RsvpID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Number of Guests</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["RsvpID"] . "</td>
                    <td>" . $row["FullName"] . "</td>
                    <td>" . $row["Email"] . "</td>
                    <td>" . $row["NumberOfGuests"] . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
    // Close the connection
$conn->close();

    } else {
        echo "Invalid username or password";
    }
}
else{
    // display a username and password form
    echo "<table><form method='post' action='index.php'>";
    echo "<tr><td>Username:</td><td><input type='text' name='username'></td></tr>";
    echo "<tr><td>Password:</td><td><input type='password' name='password'></td></tr>";
    echo "<tr><td colspan='2'><input type='submit'></td></tr>";
}
?>