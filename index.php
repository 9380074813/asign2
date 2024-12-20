<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMPETITION REGISTRATION</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
    $host = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "category";

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullName = $conn->real_escape_string($_POST['fullName']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $category = $conn->real_escape_string($_POST['category']);

        $sql = "INSERT INTO registrations(full_name, email, phone,category) VALUES ('$fullName', '$email', '$phone','$category')";
        
        if ($conn->query($sql) === TRUE) {
           
            echo "<script>
                    window.onload = function() { 
                        document.getElementById('registrationForm').style.display = 'none'; 
                        document.getElementById('successMessage').style.display = 'block';
                        document.getElementById('userDetails').innerHTML = '<p><strong>Full Name:</strong> $fullName</p><p><strong>Email:</strong> $email</p><p><strong>Phone:</strong> $phone</p><p><strong>Category:</strong> $category</p>';
                    }
                </script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }

    $conn->close();
    ?>

    <div class="form-container" id="registrationForm">
        <h1>COMPETITION REGISTRATION</h1>
        <form method="POST" onsubmit="return validateForm()">
    <fieldset>
 
        <label for="fullName">Full Name</label>
        <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required>
    
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
    
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
      
        
        
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">Select a category</option>
                    <option value="art">Art</option>
                    <option value="science">Science</option>
                    <option value="sports">Sports</option>
                    <option value="literature">Literature</option>
                </select>
            

        

       
    </fieldset>
    <button type="submit" class="btn">Submit</button>
</form>
    </div>

    <div class="success-message" id="successMessage">
        <h1>Registration Successful!</h1>
        <div id="userDetails"></div>
        <button onclick="window.location.href='index.php'">Go to Registration Page</button>
    </div>


    <script>
        function validateForm() {
            var phone = document.getElementById("phone").value;
            var phonePattern = /^[0-9]{10}$/;
            if (!phonePattern.test(phone)) {
                alert("Phone number must be 10 digits.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
