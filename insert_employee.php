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

    // Create the employee table

    function createEmployee($conn)
    {
        $emp_id = $_POST['emp_id'];
        $emp_name = $_POST['emp_name'];
        $dept_id = $_POST['dept_id'];
        $type_of_work = $_POST['type_of_work'];
        $hourly_rate = $_POST['hourly_rate'];
        $sql = "INSERT INTO employee (emp_id, emp_name, dept_id, type_of_work, hourly_rate) VALUES ('$emp_id', '$emp_name', '$dept_id', '$type_of_work', '$hourly_rate')";

        // if employee table does not exist, then create the table
        $sql_create = "CREATE TABLE IF NOT EXISTS employee (
            emp_id INT PRIMARY KEY,
            emp_name VARCHAR(100),
            dept_id INT,
            type_of_work VARCHAR(20),
            hourly_rate DECIMAL(10, 2)
        )";
        if (mysqli_query($conn, $sql_create)) {
            // echo "<script>alert('Table created successfully')</script>";
        } else {
            echo "<script>alert('Error creating table: " . mysqli_error($conn) . "')</script>";
        }



        // if emp_id exists in the table, then not write to the table
        $sql_check = "SELECT * FROM employee WHERE emp_id = '$emp_id'";
        $result = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Employee ID already exists " . mysqli_error($conn) . "')</script>";
            return;
        }

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Data inserted successfully')</script>";
        } else {
            echo "<script>alert('Error inserting data: " . mysqli_error($conn) . "')</script>";
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emp_id']) && isset($_POST['emp_name']) && isset($_POST['dept_id']) && isset($_POST['type_of_work']) && isset($_POST['hourly_rate'])) {
        createEmployee($conn);
        // header("Location: insert_employee.php");
        // exit();
    }




    // Close the database connection
    mysqli_close($conn);
    ?>

    <div class="p-24">
        <div>
            <a class="inline-block rounded bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 p-[2px] hover:text-white focus:outline-none focus:ring active:text-opacity-75" href="/">
                <span class="block rounded-sm bg-white px-8 py-3 text-sm font-medium hover:bg-transparent">
                    Back to home
                </span>
            </a>
        </div>
        <h1 class="text-3xl text-center font-bold">
            Insert an Employee
        </h1>
        <div class="m-8 flex justify-center">

            <form onsubmit="createEmployee()" method="POST">

                <input class="m-1 outline-none" type="text" name="emp_id" id="emp_id" placeholder=" Employee ID" required> <br>

                <input class="m-1 outline-none" type="text" name="emp_name" id="emp_name" placeholder=" Employee Name" required> <br>

                <!-- <input class="m-1 outline-none" type="text" name="dept_id" id="dept_id" placeholder=" Dept ID" required> -->

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
                $sql = "SELECT dept_id, dept_name FROM dept";

                // Execute the query
                $result = $conn->query($sql);

                // Check if any rows were returned
                if ($result->num_rows > 0) {
                    // Start generating the dropdown list
                    echo '<select class="mt-1.5 h-12  rounded-lg border-gray-300 text-gray-700 sm:text-sm" name="dept_id" id="dept_id" placeholder=" Dept ID" required>';
                    echo '<option disabled selected>Select Department</option>';
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $dept_id = $row["dept_id"];
                        $dept_name = $row["dept_name"];

                        // Create an option element for each row
                        echo '<option value="' . $dept_id . '">' . $dept_name . '</option>';
                    }

                    // Close the dropdown list
                    echo '</select>';
                } else {
                    echo "No results found.";
                }

                // Close the database connection
                $conn->close();
                ?>

                <br>

                <select class="mt-1.5 h-12  rounded-lg border-gray-300 text-gray-700 sm:text-sm" name="type_of_work" id="type_of_work" placeholder="Employee's type of work" required>
                    <option value=>Select Type of Work</option>
                    <option value="F">Full Time</option>
                    <option value="H">Half Time</option>
                </select>
                <br>

                <!-- <input class="m-1 outline-none" type="text" name="type_of_work" id="type_of_work" placeholder=" Employee's type of work" required> <br> -->

                <input class="m-1 outline-none" type="text" name="hourly_rate" id="hourly_rate" placeholder=" Employee's hourly rate" required> <br>

                <div class="flex w-screen-full justify-center">

                    <input class="w-2/3 block rounded text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:m-3 outline-none dark:focus:ring-blue-800" type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>

</body>

</html>