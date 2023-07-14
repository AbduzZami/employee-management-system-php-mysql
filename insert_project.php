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

    // Create the project table

    function createProject($conn)
    {
        $project_id = $_POST['project_id'];
        $project_name = $_POST['project_name'];
        $project_location = $_POST['project_location'];

        $sql = "INSERT INTO project (project_id, project_name, project_location) VALUES ('$project_id', '$project_name', '$project_location')";

        // If the project table does not exist, then create the table
        $sql_create = "CREATE TABLE IF NOT EXISTS project (
            project_id INT PRIMARY KEY,
            project_name VARCHAR(100),
            project_location VARCHAR(100)
        )";
        if (mysqli_query($conn, $sql_create)) {
            // echo "<script>alert('Table created successfully')</script>";
        } else {
            echo "<script>alert('Error creating table: " . mysqli_error($conn) . "')</script>";
        }

        // If project_id exists in the table, then do not write to the table
        $sql_check = "SELECT * FROM project WHERE project_id = '$project_id'";
        $result = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Project ID already exists " . mysqli_error($conn) . "')</script>";
            return;
        }

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Data inserted successfully')</script>";
            header_remove();
        } else {
            echo "<script>alert('Error inserting data: " . mysqli_error($conn) . "')</script>";
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['project_id']) && isset($_POST['project_name']) && isset($_POST['project_location'])) {
        createProject($conn);
        // header("Location: insert_project.php");
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
            Insert a Project
        </h1>
        <div class="m-8 flex justify-center">
            <form method="POST">
                <input class="m-1 outline-none" type="text" name="project_id" id="project_id" placeholder="Project ID" required> <br>
                <input class="m-1 outline-none" type="text" name="project_name" id="project_name" placeholder="Project Name" required> <br>
                <input class="m-1 outline-none" type="text" name="project_location" id="project_location" placeholder="Project Location" required> <br>
                <div class="flex w-screen-full justify-center">
                    <input class="w-2/3 block rounded text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:m-3 outline-none dark:focus:ring-blue-800" type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>

</html>
