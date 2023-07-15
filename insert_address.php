<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    <?php
    $host = 'localhost';
    $username = 'root';
    $password = 'admin';
    $database = 'employee_db';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Create the address table
    function createAddress($conn)
    {
        $emp_id = $_POST['emp_id'];
        $street_no = $_POST['street_no'];
        $street_name = $_POST['street_name'];
        $city = $_POST['city'];
        $zip_code = $_POST['zip_code'];

        $sql_create = "CREATE TABLE IF NOT EXISTS address (
            emp_id INT PRIMARY KEY,
            street_no VARCHAR(100),
            street_name VARCHAR(100),
            city VARCHAR(100),
            zip_code VARCHAR(10),
            FOREIGN KEY (emp_id) REFERENCES employee(emp_id)
          )";

        if (mysqli_query($conn, $sql_create)) {
            // echo "<script>alert('Table created successfully')</script>";
        } else {
            echo "<script>alert('Error creating table: " . mysqli_error($conn) . "')</script>";
            return;
        }

        $sql_check = "SELECT * FROM address WHERE emp_id = '$emp_id'";
        $result = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Emp ID already exists')</script>";
            return;
        }

        $sql = "INSERT INTO address (emp_id, street_no, street_name, city, zip_code) VALUES ('$emp_id', '$street_no', '$street_name', '$city', '$zip_code')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Data inserted successfully')</script>";
        } else {
            echo "<script>alert('Error inserting data: " . mysqli_error($conn) . "')</script>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emp_id']) && isset($_POST['street_no']) && isset($_POST['street_name']) && isset($_POST['city']) && isset($_POST['zip_code'])) {
        createAddress($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <div style="width:calc(100vw - 100px);">
        <h1 class="text-3xl text-left font-bold m-20">
            Insert an Address
        </h1>
        <div class="m-8 ml-20 flex justify-start">
            <form method="POST">
                <?php
                // Database connection parameters
                $servername = "localhost";
                $username = "root";
                $password = "admin";
                $dbname = "employee_db";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to retrieve data from the database
                $sql = "SELECT emp_id, emp_name FROM employee";

                // Execute the query
                $result = $conn->query($sql);

                // Check if any rows were returned
                if ($result->num_rows > 0) {
                    // Start generating the dropdown list
                    echo '<select class="mt-1.5 h-12  rounded-lg border-gray-300 text-gray-700 sm:text-sm" name="emp_id" required>';
                    echo '<option disabled selected>Select Employee</option>';
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $emp_id = $row["emp_id"];
                        $emp_name = $row["emp_name"];

                        // Create an option element for each row
                        echo '<option value="' . $emp_id . '">' . $emp_name . '</option>';
                    }

                    // Close the dropdown list
                    echo '</select>';
                } else {
                    echo "No results found.";
                }

                // Close the database connection
                $conn->close();
                ?>
                <input class="m-1 outline-none" type="text" name="street_no" placeholder=" Street No" required> <br>
                <input class="m-1 outline-none w-full" type="text" name="street_name" placeholder=" Street Name" required> <br>
                <input class="m-1 outline-none" type="text" name="city" placeholder=" City" required> <br>
                <input class="m-1 outline-none" type="text" name="zip_code" placeholder=" Zip Code" required> <br>
                <div class="flex  justify-center">
                    <button class="inline-block rounded border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:outline-none focus:ring active:text-indigo-500" type="submit">Insert</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>

</html>