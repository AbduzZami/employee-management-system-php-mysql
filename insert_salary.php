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

    // Create the salary table

    function createSalary($conn)
    {
        $emp_no = $_POST['emp_no'];
        $basic = $_POST['basic'];
        $allowance = 0.45 * $basic;
        $deduction = (0.09 * $basic) + (0.25 * $basic);
        $net_salary = $basic + $allowance - $deduction;
        $salary_date = $_POST['salary_date'];

        $sql = "INSERT INTO salary (emp_no, basic, allowance, deduction, net_salary, salary_date) VALUES ('$emp_no', '$basic', '$allowance', '$deduction', '$net_salary', '$salary_date')";

        // if salary table does not exist, then create the table
        $sql_create = "CREATE TABLE IF NOT EXISTS salary (
        emp_no INT PRIMARY KEY,
        basic DECIMAL(10, 2),
        allowance DECIMAL(10, 2) GENERATED ALWAYS AS (0.45 * basic) STORED,
        deduction DECIMAL(10, 2) GENERATED ALWAYS AS ((0.09 * basic) + (0.25 * basic)) STORED,
        net_salary DECIMAL(10, 2) GENERATED ALWAYS AS (basic + allowance - deduction) STORED,
        salary_date DATE,
        FOREIGN KEY (emp_no) REFERENCES employee(emp_id)
    )";
        if (mysqli_query($conn, $sql_create)) {
            // echo "<script>alert('Table created successfully')</script>";
        } else {
            echo "<script>alert('Error creating table: " . mysqli_error($conn) . "')</script>";
        }

        // if emp_no exists in the table, then do not write to the table
        $sql_check = "SELECT * FROM salary WHERE emp_no = '$emp_no'";
        $result = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Employee number already exists')</script>";
            return;
        }

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Data inserted successfully')</script>";
            header_remove();
        } else {
            echo "<script>alert('Error inserting data: " . mysqli_error($conn) . "')</script>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emp_no']) && isset($_POST['basic']) && isset($_POST['salary_date'])) {
        createSalary($conn);
        // header("Location: insert_salary.php");
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
            Insert Salary Details
        </h1>
        <div class="m-8 flex justify-center">
            <form onsubmit="createSalary()" method="POST">
                <input class="m-1 outline-none" type="text" name="emp_no" id="emp_no" placeholder="Employee Number" required> <br>
                <input class="m-1 outline-none" type="text" name="basic" id="basic" placeholder="Basic Salary" required> <br>
                <input class="m-1 outline-none" type="date" name="salary_date" id="salary_date" placeholder="Salary Date" required> <br>
                <div class="flex w-screen-full justify-center">
                    <input class="w-2/3 block rounded text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:m-3 outline-none dark:focus:ring-blue-800" type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <script>
        function createSalary() {
            // Functionality handled by PHP code
        }
    </script>
</body>

</html>