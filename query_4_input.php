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


    function createFtPtWork()
    {
        $project_name = $_POST['project_name'];
        $dept_name = $_POST['dept_name'];
        $project_location = $_POST['project_location'];

        // Construct the URL with parameters
        $url = 'query_1.php?project_name=' . urlencode($project_name) . '&dept_name=' . urlencode($dept_name)
            . '&project_location=' . urlencode($project_location);;

        // Redirect to the second page
        header("Location: $url");
        exit;
    }

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Call the PHP function to handle redirection
        createFtPtWork();
    }

    ?>

    <div class="p-24">
        <div>
            <a href="index.php" class="hover:underline italic">Back to Home</a>
        </div>
        <h1 class="text-3xl text-center font-bold">
            List the names of all Engineers in Googong Subdivision project located at Googong city
        </h1>
        <div class="m-8 flex justify-center">
            <form method="POST" onsubmit="createFtPtWork()">
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
                    echo '<select class="mt-1.5 h-12  rounded-lg border-gray-300 text-gray-700 sm:text-sm" name="project_name" id="project_name" placeholder=" Project Name" required>';
                    echo '<option disabled selected>Select Project</option>';
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $project_id = $row["project_id"];
                        $project_name = $row["project_name"];

                        // Create an option element for each row
                        echo '<option value="' . $project_name . '">' . $project_name . '</option>';
                    }

                    // Close the dropdown list
                    echo '</select>';
                } else {
                    echo "No results found.";
                }

                // Close the database connection
                $conn->close();
                ?>
                <!-- <input class="m-1 outline-none" type="text" name="project_id" id="project_id" placeholder="Project ID" required> <br> -->

                <!-- <input class="m-1 outline-none" type="text" name="emp_id" id="emp_id" placeholder="Employee ID" required> <br> -->
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
                    echo '<select class="mt-1.5 h-12  rounded-lg border-gray-300 text-gray-700 sm:text-sm" name="dept_name" id="dept_name" placeholder=" Dept Name" required>';
                    echo '<option disabled selected>Select Department</option>';
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $dept_id = $row["dept_id"];
                        $dept_name = $row["dept_name"];

                        // Create an option element for each row
                        echo '<option value="' . $dept_name . '">' . $dept_name . '</option>';
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
                $sql = "SELECT DISTINCT project_location FROM project";

                // Execute the query
                $result = $conn->query($sql);

                // Check if any rows were returned
                if ($result->num_rows > 0) {
                    // Start generating the dropdown list
                    echo '<select class="mt-1.5 h-12  rounded-lg border-gray-300 text-gray-700 sm:text-sm" name="project_location" id="project_location" placeholder=" Project Location" required>';
                    echo '<option disabled selected>Select Location</option>';
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $project_location = $row["project_location"];

                        // Create an option element for each row
                        echo '<option value="' . $project_location . '">' . $project_location . '</option>';
                    }

                    // Close the dropdown list
                    echo '</select>';
                } else {
                    echo "No results found.";
                }

                // Close the database connection
                $conn->close();
                ?>


                <!-- <input class="m-1 outline-none" type="text" name="dept_id" id="dept_id" placeholder="Department ID" required> <br> -->
                <!-- <input class="m-1 outline-none" type="text" name="num_of_hours" id="num_of_hours" placeholder="Number of Hours" required> <br> -->
                <div class="flex w-screen-full justify-center">
                    <input class="w-2/3 block rounded text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:m-3 outline-none dark:focus:ring-blue-800" type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>

</html>