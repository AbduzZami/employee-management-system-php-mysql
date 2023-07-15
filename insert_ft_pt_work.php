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

    // Create the ft_pt_work table

    function createFtPtWork($conn)
    {
        $project_id = $_POST['project_id'];
        $emp_id = $_POST['emp_id'];
        $dept_id = $_POST['dept_id'];
        $work_date = $_POST['work_date'];
        $num_of_hours = $_POST['num_of_hours'];

        $sql = "INSERT INTO ft_pt_work (project_id, emp_id, dept_id, work_date, num_of_hours) VALUES ('$project_id', '$emp_id', '$dept_id', '$work_date', '$num_of_hours')";

        // If the ft_pt_work table does not exist, then create the table
        $sql_create = "CREATE TABLE IF NOT EXISTS ft_pt_work (
            project_id INT,
            emp_id INT,
            dept_id INT,
            num_of_hours DECIMAL(10, 2),
            work_date DATE,
            FOREIGN KEY (emp_id) REFERENCES employee(emp_id),
            FOREIGN KEY (dept_id) REFERENCES dept(dept_id),
            FOREIGN KEY (project_id) REFERENCES project(project_id)
        )";
        if (mysqli_query($conn, $sql_create)) {
            // echo "<script>alert('Table created successfully')</script>";
        } else {
            echo "<script>alert('Error creating table: " . mysqli_error($conn) . "')</script>";
        }

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Data inserted successfully')</script>";
            header_remove();
        } else {
            echo "<script>alert('Error inserting data: " . mysqli_error($conn) . "')</script>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['project_id']) && isset($_POST['emp_id']) && isset($_POST['dept_id']) && isset($_POST['num_of_hours']) && isset($_POST['work_date'])) {
        createFtPtWork($conn);
        // header("Location: insert_ft_pt_work.php");
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
            Insert FT-PT Work
        </h1>
        <div class="m-8 flex justify-center">
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
                $sql = "SELECT project_id, project_name FROM project";

                // Execute the query
                $result = $conn->query($sql);

                // Check if any rows were returned
                if ($result->num_rows > 0) {
                    // Start generating the dropdown list
                    echo '<select class="mt-1.5 h-12  rounded-lg border-gray-300 text-gray-700 sm:text-sm" name="project_id" id="project_id" placeholder=" Project ID" required>';
                    echo '<option disabled selected>Select Project</option>';
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $project_id = $row["project_id"];
                        $project_name = $row["project_name"];

                        // Create an option element for each row
                        echo '<option value="' . $project_id . '">' . $project_name . '</option>';
                    }

                    // Close the dropdown list
                    echo '</select>';
                } else {
                    echo "No results found.";
                }

                // Close the database connection
                $conn->close();
                ?>

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
                    echo '<select class="mt-1.5 h-12  rounded-lg border-gray-300 text-gray-700 sm:text-sm" name="emp_id" id="emp_id" placeholder=" Employee ID" required>';
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


                <input class="m-1 outline-none" type="date" name="work_date" id="work_date" placeholder="Work Date" required> <br>
                <input class="m-1 outline-none" type="text" name="num_of_hours" id="num_of_hours" placeholder="Number of Hours" required> <br>
                <div class="flex w-screen-full justify-center">
                    <input class="w-2/3 block rounded text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:m-3 outline-none dark:focus:ring-blue-800" type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>

</html>