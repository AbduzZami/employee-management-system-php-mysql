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

        $sql = "INSERT INTO address (emp_id, street_no, street_name, city, zip_code) VALUES ('$emp_id', '$street_no', '$street_name', '$city', '$zip_code')";

        // if address table does not exist, then create the table
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
        }

        // if emp_id exists in the table, then do not write to the table
        $sql_check = "SELECT * FROM address WHERE emp_id = '$emp_id'";
        $result = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Emp ID already exists " . mysqli_error($conn) . "')</script>";
            return;
        }

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Data inserted successfully')</script>";
            header_remove();
        } else {
            echo "<script>alert('Error inserting data: " . mysqli_error($conn) . "')</script>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emp_id']) && isset($_POST['street_no']) && isset($_POST['street_name']) && isset($_POST['city']) && isset($_POST['zip_code'])) {
        createAddress($conn);
        // header("Location: insert_address.php");
        // exit();
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <div class="p-24">
        <div>
            <a href="index.php" class="hover:underline italic">Back to Home</a>
        </div>
        <h1 class="text-3xl text-center font-bold">
            Insert an Address
        </h1>
        <div class="m-8 flex justify-center">
            <form onsubmit="createAddress()" method="POST">
                <input class="m-1 outline-none" type="text" name="emp_id" id="emp_id" placeholder=" Employee ID" required> <br>
                <input class="m-1 outline-none" type="text" name="street_no" id="street_no" placeholder=" Street No" required> <br>
                <input class="m-1 outline-none" type="text" name="street_name" id="street_name" placeholder=" Street Name" required> <br>
                <input class="m-1 outline-none" type="text" name="city" id="city" placeholder=" City" required> <br>
                <input class="m-1 outline-none" type="text" name="zip_code" id="zip_code" placeholder=" Zip Code" required> <br>
                <div class="flex w-screen-full justify-center">
                    <input class="w-2/3 block rounded text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:m-3 outline-none dark:focus:ring-blue-800" type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <script>
        function createAddress() {
            // Functionality handled by PHP code
        }
    </script>
</body>

</html>