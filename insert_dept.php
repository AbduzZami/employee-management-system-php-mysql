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

    function createDept($conn)
    {
        $dept_id = $_POST['dept_id'];
        $dept_name = $_POST['dept_name'];
        $dept_location = $_POST['dept_location'];

        $sql = "INSERT INTO dept (dept_id, dept_name, dept_location) VALUES ('$dept_id', '$dept_name', '$dept_location')";

        // if dept table does not exist, then create the table
        $sql_create = "CREATE TABLE IF NOT EXISTS dept (
            dept_id INT PRIMARY KEY,
            dept_name VARCHAR(100),
            dept_location VARCHAR(100)
        )";
        if (mysqli_query($conn, $sql_create)) {
            // echo "<script>alert('Table created successfully')</script>";
        } else {
            echo "<script>alert('Error creating table: " . mysqli_error($conn) . "')</script>";
        }

        // if dept_id exists in the table, then not write to the table
        $sql_check = "SELECT * FROM dept WHERE dept_id = '$dept_id'";
        $result = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Dept ID already exists " . mysqli_error($conn) . "')</script>";
            return;
        }

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Data inserted successfully')</script>";
            header_remove();
        } else {
            echo "<script>alert('Error inserting data: " . mysqli_error($conn) . "')</script>";
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dept_id']) && isset($_POST['dept_name']) && isset($_POST['dept_location'])) {
        createDept($conn);
        // header("Location: insert_dept.php");
        // exit();
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <div class="p-24">
        <a class="inline-block rounded bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 p-[2px] hover:text-white focus:outline-none focus:ring active:text-opacity-75" href="/">
            <span class="block rounded-sm bg-white px-8 py-3 text-sm font-medium hover:bg-transparent">
                Back to home
            </span>
        </a>
        <h1 class="text-3xl text-center font-bold">
            Insert a Department
        </h1>
        <div class="m-8 flex justify-center">
            <form onsubmit="createDept()" method="POST">
                <input class="m-1 outline-none" type="text" name="dept_id" id="dept_id" placeholder=" Department ID" required> <br>
                <input class="m-1 outline-none" type="text" name="dept_name" id="dept_name" placeholder=" Department Name" required> <br>
                <input class="m-1 outline-none" type="text" name="dept_location" id="dept_location" placeholder=" Department Location" required> <br>
                <div class="flex w-screen-full justify-center">
                    <input class="w-2/3 block rounded text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:m-3 outline-none dark:focus:ring-blue-800" type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <script>
        function createDept() {
            // Functionality handled by PHP code
        }
    </script>
</body>

</html>