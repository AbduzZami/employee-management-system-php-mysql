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
        $num_of_hours = $_POST['num_of_hours'];

        $sql = "INSERT INTO ft_pt_work (project_id, emp_id, dept_id, num_of_hours) VALUES ('$project_id', '$emp_id', '$dept_id', '$num_of_hours')";

        // If the ft_pt_work table does not exist, then create the table
        $sql_create = "CREATE TABLE IF NOT EXISTS ft_pt_work (
            project_id INT,
            emp_id INT,
            dept_id INT,
            num_of_hours DECIMAL(10, 2),
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

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['project_id']) && isset($_POST['emp_id']) && isset($_POST['dept_id']) && isset($_POST['num_of_hours'])) {
        createFtPtWork($conn);
        // header("Location: insert_ft_pt_work.php");
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
            Insert FT-PT Work
        </h1>
        <div class="m-8 flex justify-center">
            <form method="POST">
                <input class="m-1 outline-none" type="text" name="project_id" id="project_id" placeholder="Project ID" required> <br>
                <input class="m-1 outline-none" type="text" name="emp_id" id="emp_id" placeholder="Employee ID" required> <br>
                <input class="m-1 outline-none" type="text" name="dept_id" id="dept_id" placeholder="Department ID" required> <br>
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
