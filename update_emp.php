<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
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

    function getEmployee($conn)
    {
        $emp_id = $_GET['emp_id'];

        $sql = "SELECT * FROM employee WHERE emp_id = '$emp_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            echo "<script>alert('No employee found for the employee ID: $emp_id')</script>";
            return null;
        }
    }

    function updateEmployee($conn)
    {
        $emp_id = $_POST['emp_id'];
        $emp_name = $_POST['emp_name'];
        $dept_id = $_POST['dept_id'];
        $type_of_work = $_POST['type_of_work'];
        $hourly_rate = $_POST['hourly_rate'];

        $sql = "UPDATE employee SET emp_name = '$emp_name', dept_id = '$dept_id', type_of_work = '$type_of_work', hourly_rate = '$hourly_rate' WHERE emp_id = '$emp_id'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Employee updated successfully')</script>";
        } else {
            echo "<script>alert('Error updating employee: " . mysqli_error($conn) . "')</script>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emp_id']) && isset($_POST['emp_name']) && isset($_POST['dept_id']) && isset($_POST['type_of_work']) && isset($_POST['hourly_rate'])) {
        updateEmployee($conn);
    }

    // Get the employee data
    $employee = getEmployee($conn);

    // Close the database connection
    mysqli_close($conn);
    ?>

    <div class="container mx-auto mt-20">
        <a class="inline-block rounded bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 p-[2px] hover:text-white focus:outline-none focus:ring active:text-opacity-75" href="/">
            <span class="block rounded-sm bg-white px-8 py-3 text-sm font-medium hover:bg-transparent">
                Back to home
            </span>
        </a>

        <h1 class="text-3xl text-center text-left font-bold m-20">
            Edit Employee
        </h1>

        <div class="m-8 ml-20 flex justify-center">
            <?php if ($employee) : ?>
                <form method="POST">
                    <input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>">
                    <input class="m-1 outline-none" type="text" name="emp_name" placeholder="Employee Name" value="<?php echo $employee['emp_name']; ?>" required> <br>

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
                        echo '<select class="mt-1.5 h-12  rounded-lg border-gray-300 text-gray-700 sm:text-sm" name="dept_id" placeholder="Dept ID" required>';
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $dept_id = $row["dept_id"];
                            $dept_name = $row["dept_name"];

                            // Create an option element for each row
                            $selected = ($dept_id == $employee['dept_id']) ? 'selected' : '';
                            echo '<option value="' . $dept_id . '" ' . $selected . '>' . $dept_name . '</option>';
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

                    <select class="mt-1.5 h-12  rounded-lg border-gray-300 text-gray-700 sm:text-sm" name="type_of_work" placeholder="Employee's type of work" required>
                        <option value="">Select Type of Work</option>
                        <option value="F" <?php echo ($employee['type_of_work'] == 'F') ? 'selected' : ''; ?>>Full Time</option>
                        <option value="H" <?php echo ($employee['type_of_work'] == 'H') ? 'selected' : ''; ?>>Half Time</option>
                    </select>
                    <br>

                    <input class="m-1 outline-none" type="text" name="hourly_rate" placeholder="Employee's hourly rate" value="<?php echo $employee['hourly_rate']; ?>" required> <br>

                    <div class="flex justify-center">
                        <button class="inline-block rounded border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:outline-none focus:ring active:text-indigo-500" type="submit">Update</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>

</html>